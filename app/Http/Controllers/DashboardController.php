<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\FormType;
use App\Models\SubmissionApproval;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $stats = [
                'total_submissions' => FormSubmission::count(),
                'pending'           => FormSubmission::where('status', 'pending')->count(),
                'approved'          => FormSubmission::where('status', 'approved')->count(),
                'rejected'          => FormSubmission::where('status', 'rejected')->count(),
            ];
            $recent = FormSubmission::with(['formType', 'submitter'])
                ->latest()->limit(10)->get();
            return view('dashboard.admin', compact('stats', 'recent'));
        }

        if ($user->isStudent()) {
            $submissions = FormSubmission::with(['formType'])
                ->where('submitter_id', $user->id)
                ->latest()->get();
            $formTypes = FormType::where('is_active', true)->orderBy('name')->get();
            return view('dashboard.student', compact('submissions', 'formTypes'));
        }

        // Approver roles
        $pending = SubmissionApproval::with(['submission.formType', 'submission.submitter', 'workflowStep'])
            ->where('action', 'pending')
            ->whereHas('workflowStep', fn($q) => $q->where('approver_role', $user->role))
            ->whereHas('submission', fn($q) => $q->whereColumn('current_step_order', 'submission_approvals.step_order'))
            ->latest()->get();

        $recent = SubmissionApproval::with(['submission.formType', 'submission.submitter'])
            ->where('approver_id', $user->id)
            ->where('action', '!=', 'pending')
            ->latest('acted_at')->limit(10)->get();

        return view('dashboard.approver', compact('pending', 'recent'));
    }
}
