<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_request_dean_faculty', function (Blueprint $table) {
            $table->increments('dean_fac_id');
            $table->string('dean_fac_title', 10)->nullable();
            $table->string('dean_fac_name', 40)->nullable();
            $table->string('dean_fac_surname', 40)->nullable();
            $table->unsignedSmallInteger('dean_faculty_id')->nullable();
            $table->string('dean_position', 20)->nullable()->comment('dean หรือ vice_dean');
            $table->boolean('dean_can_sign')->default(true)->comment('1=ลงนามได้, 0=ไม่ได้');
            $table->string('dean_username', 40)->nullable();
            $table->string('dean_pass', 50)->nullable();
            $table->string('dean_id_crad', 13)->nullable();
            $table->string('dean_email', 40)->nullable();
            $table->string('dean_ses', 8)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_request_dean_faculty');
    }
};
