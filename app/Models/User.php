<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'student_id',
        'department', 'avatar', 'signature', 'google_id', 'microsoft_id', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public const ROLES = [
        'admin'            => 'ผู้ดูแลระบบ',
        'student'          => 'นักศึกษา',
        'advisor'          => 'อาจารย์ที่ปรึกษา',
        'program_chair'    => 'ประธานหลักสูตร',
        'faculty_dean'     => 'คณบดีคณะ',
        'graduate_officer' => 'เจ้าหน้าที่บัณฑิต',
        'grad_vice_dean'   => 'รองวิชาการบัณฑิต',
        'grad_dean'        => 'คณบดีบัณฑิต',
    ];

    public function getRoleNameAttribute(): string
    {
        return __('ui.roles.' . $this->role) ?: (self::ROLES[$this->role] ?? $this->role);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function canApprove(): bool
    {
        return in_array($this->role, ['advisor', 'program_chair', 'faculty_dean', 'graduate_officer', 'grad_vice_dean', 'grad_dean']);
    }

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class, 'submitter_id');
    }

    public function approvals()
    {
        return $this->hasMany(SubmissionApproval::class, 'approver_id');
    }
}
