<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
        'form_type_id', 'submitter_id', 'current_step_order',
        'status', 'remarks', 'submitted_at', 'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public const STATUSES = [
        'draft'    => ['label' => 'ร่าง',          'color' => 'gray'],
        'pending'  => ['label' => 'รอการอนุมัติ',   'color' => 'yellow'],
        'approved' => ['label' => 'อนุมัติแล้ว',    'color' => 'green'],
        'rejected' => ['label' => 'ไม่อนุมัติ',     'color' => 'red'],
        'returned' => ['label' => 'ส่งคืนแก้ไข',   'color' => 'orange'],
    ];

    public function getStatusLabelAttribute(): string
    {
        return __('ui.submission.status.' . $this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUSES[$this->status]['color'] ?? 'gray';
    }

    public function formType()
    {
        return $this->belongsTo(FormType::class);
    }

    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitter_id');
    }

    public function fieldValues()
    {
        return $this->hasMany(SubmissionFieldValue::class, 'submission_id');
    }

    public function approvals()
    {
        return $this->hasMany(SubmissionApproval::class, 'submission_id')->orderBy('step_order');
    }

    public function currentApproval()
    {
        return $this->hasOne(SubmissionApproval::class, 'submission_id')
            ->where('step_order', $this->current_step_order)
            ->where('action', 'pending');
    }

    public function getFieldValue(string $key): ?string
    {
        return $this->fieldValues->firstWhere('field_key', $key)?->value;
    }
}
