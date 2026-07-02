<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submission_field_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('form_submissions')->cascadeOnDelete();
            $table->string('field_key');
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(['submission_id', 'field_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submission_field_values');
    }
};
