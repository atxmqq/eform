<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_request_staff_faculty', function (Blueprint $table) {
            $table->increments('staff_fac_id');
            $table->string('staff_fac_title', 10)->nullable();
            $table->string('staff_fac_name', 40)->nullable();
            $table->string('staff_fac_surname', 40)->nullable();
            $table->unsignedSmallInteger('staff_faculty_id')->nullable();
            $table->string('staff_username', 40)->nullable();
            $table->string('staff_pass', 50)->nullable();
            $table->string('staff_id_crad', 15)->nullable();
            $table->string('staff_email', 40)->nullable();
            $table->string('staff_ses', 8)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_request_staff_faculty');
    }
};
