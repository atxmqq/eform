<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submission_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('form_submissions')->cascadeOnDelete();
            $table->foreignId('workflow_step_id')->constrained('workflow_steps');
            $table->integer('step_order');
            $table->foreignId('approver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action')->default('pending');
            $table->text('comment')->nullable();
            $table->timestamp('acted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submission_approvals');
    }
};
