<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionApproval extends Model
{
    protected $fillable = [
        'submission_id', 'workflow_step_id', 'step_order',
        'approver_id', 'action', 'comment', 'acted_at',
    ];

    protected function casts(): array
    {
        return ['acted_at' => 'datetime'];
    }

    public const ACTIONS = [
        'pending'  => ['label' => 'รอดำเนินการ', 'color' => 'yellow'],
        'approved' => ['label' => 'อนุมัติ',      'color' => 'green'],
        'rejected' => ['label' => 'ไม่อนุมัติ',  'color' => 'red'],
        'returned' => ['label' => 'ส่งคืนแก้ไข', 'color' => 'orange'],
    ];

    public function getActionLabelAttribute(): string
    {
        return __('ui.approval.action.' . $this->action);
    }

    public function getActionColorAttribute(): string
    {
        return self::ACTIONS[$this->action]['color'] ?? 'gray';
    }

    public function submission()
    {
        return $this->belongsTo(FormSubmission::class, 'submission_id');
    }

    public function workflowStep()
    {
        return $this->belongsTo(WorkflowStep::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
