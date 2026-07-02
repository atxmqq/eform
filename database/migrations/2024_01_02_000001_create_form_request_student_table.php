<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_request_student', function (Blueprint $table) {
            $table->increments('std_id');
            $table->string('std_id_std', 11)->nullable();
            $table->string('std_id_crad', 20)->nullable();
            $table->string('std_fname_th', 40)->nullable();
            $table->string('std_lname_th', 40)->nullable();
            $table->string('std_fname_en', 40)->nullable();
            $table->string('std_lname_en', 40)->nullable();
            $table->string('std_province_th', 30)->nullable();
            $table->string('std_degree_th', 40)->nullable();
            $table->string('std_faculty_th', 60)->nullable();
            $table->unsignedSmallInteger('std_faculty_id')->nullable();
            $table->string('std_major_th', 60)->nullable();
            $table->string('std_province_en', 40)->nullable();
            $table->string('std_degree_en', 60)->nullable();
            $table->string('std_faculty_en', 60)->nullable();
            $table->string('std_major_en', 60)->nullable();
            $table->string('std_img', 50)->nullable();
            $table->string('std_email', 100)->nullable();
            $table->dateTime('std_modifile')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_request_student');
    }
};
