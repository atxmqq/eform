<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workflow_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_type_id')->constrained()->cascadeOnDelete();
            $table->integer('step_order');
            $table->string('step_name');
            $table->string('approver_role');
            $table->boolean('can_reject')->default(true);
            $table->boolean('can_return')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_steps');
    }
};
