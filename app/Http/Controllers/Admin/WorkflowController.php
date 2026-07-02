<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormType;
use App\Models\User;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function store(Request $request, FormType $formType)
    {
        $request->validate([
            'step_name'    => 'required|string|max:255',
            'approver_role' => 'required|in:' . implode(',', array_keys(collect(User::ROLES)->except(['admin', 'student'])->all())),
            'can_reject'   => 'boolean',
            'can_return'   => 'boolean',
        ]);

        $order = $formType->workflowSteps()->max('step_order') + 1;

        $formType->workflowSteps()->create([
            'step_order'   => $order,
            'step_name'    => $request->step_name,
            'approver_role' => $request->approver_role,
            'can_reject'   => $request->boolean('can_reject', true),
            'can_return'   => $request->boolean('can_return', true),
        ]);

        return back()->with('success', 'เพิ่มขั้นตอนการอนุมัติสำเร็จ');
    }

    public function destroy(FormType $formType, WorkflowStep $step)
    {
        $step->delete();
        $formType->workflowSteps()->orderBy('step_order')->get()
            ->each(fn($s, $i) => $s->update(['step_order' => $i + 1]));
        return back()->with('success', 'ลบขั้นตอนสำเร็จ');
    }

    public function reorder(Request $request, FormType $formType)
    {
        $request->validate(['steps' => 'required|array']);
        foreach ($request->steps as $index => $id) {
            WorkflowStep::where('id', $id)->where('form_type_id', $formType->id)
                ->update(['step_order' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}
