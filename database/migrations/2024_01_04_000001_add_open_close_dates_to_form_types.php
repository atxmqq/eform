<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_types', function (Blueprint $table) {
            $table->dateTime('opens_at')->nullable()->after('is_active');
            $table->dateTime('closes_at')->nullable()->after('opens_at');
        });
    }

    public function down(): void
    {
        Schema::table('form_types', function (Blueprint $table) {
            $table->dropColumn(['opens_at', 'closes_at']);
        });
    }
};
