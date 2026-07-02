<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use App\Models\SubmissionApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $pending = SubmissionApproval::with(['submission.formType', 'submission.submitter', 'workflowStep'])
            ->where('action', 'pending')
            ->whereHas('workflowStep', fn($q) => $q->where('approver_role', $user->role))
            ->whereHas('submission', fn($q) => $q->whereColumn('current_step_order', 'submission_approvals.step_order'))
            ->latest()->paginate(15);

        return view('approver.index', compact('pending'));
    }

    public function show(FormSubmission $submission)
    {
        $user = auth()->user();

        $approval = SubmissionApproval::where('submission_id', $submission->id)
            ->where('step_order', $submission->current_step_order)
            ->where('action', 'pending')
            ->whereHas('workflowStep', fn($q) => $q->where('approver_role', $user->role))
            ->firstOrFail();

        $submission->load(['formType.fields', 'fieldValues', 'approvals.workflowStep', 'approvals.approver']);

        return view('approver.show', compact('submission', 'approval'));
    }

    public function act(Request $request, FormSubmission $submission)
    {
        $user = $request->user();

        $request->validate([
            'action'  => 'required|in:approved,rejected,returned',
            'comment' => 'nullable|string|max:1000',
        ]);

        $approval = SubmissionApproval::where('submission_id', $submission->id)
            ->where('step_order', $submission->current_step_order)
            ->where('action', 'pending')
            ->whereHas('workflowStep', fn($q) => $q->where('approver_role', $user->role))
            ->firstOrFail();

        DB::transaction(function () use ($request, $submission, $approval, $user) {
            $approval->update([
                'approver_id' => $user->id,
                'action'      => $request->action,
                'comment'     => $request->comment,
                'acted_at'    => now(),
            ]);

            if ($request->action === 'approved') {
                $nextApproval = SubmissionApproval::where('submission_id', $submission->id)
                    ->where('step_order', '>', $submission->current_step_order)
                    ->orderBy('step_order')
                    ->first();

                if ($nextApproval) {
                    $nextApproval->update(['action' => 'pending']);
                    $submission->update(['current_step_order' => $nextApproval->step_order]);
                } else {
                    $submission->update([
                        'status'       => 'approved',
                        'current_step_order' => null,
                        'completed_at' => now(),
                    ]);
                }
            } elseif ($request->action === 'rejected') {
                $submission->update([
                    'status'       => 'rejected',
                    'current_step_order' => null,
                    'completed_at' => now(),
                ]);
            } elseif ($request->action === 'returned') {
                $submission->update([
                    'status'       => 'returned',
                    'current_step_order' => null,
                    'completed_at' => null,
                ]);
            }
        });

        return redirect()->route('approver.index')->with('success', 'ดำเนินการสำเร็จ');
    }
}
