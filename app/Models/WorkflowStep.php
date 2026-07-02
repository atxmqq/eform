<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkflowStep extends Model
{
    protected $fillable = [
        'form_type_id', 'step_order', 'step_name', 'approver_role', 'can_reject', 'can_return',
    ];

    protected function casts(): array
    {
        return [
            'can_reject' => 'boolean',
            'can_return' => 'boolean',
        ];
    }

    public function formType()
    {
        return $this->belongsTo(FormType::class);
    }

    public function approvals()
    {
        return $this->hasMany(SubmissionApproval::class);
    }

    public function getRoleNameAttribute(): string
    {
        return User::ROLES[$this->approver_role] ?? $this->approver_role;
    }
}
