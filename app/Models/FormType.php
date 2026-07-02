<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'description', 'is_active', 'opens_at', 'closes_at'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'opens_at'  => 'datetime',
            'closes_at' => 'datetime',
        ];
    }

    public function isOpen(): bool
    {
        $now = now();
        if ($this->opens_at && $now->lt($this->opens_at)) return false;
        if ($this->closes_at && $now->gt($this->closes_at)) return false;
        return true;
    }

    public function fields()
    {
        return $this->hasMany(FormField::class)->orderBy('sort_order');
    }

    public function workflowSteps()
    {
        return $this->hasMany(WorkflowStep::class)->orderBy('step_order');
    }

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }
}
