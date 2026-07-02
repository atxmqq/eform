<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_request_staff', function (Blueprint $table) {
            $table->increments('staff_id');
            $table->string('staff_name', 60)->nullable();
            $table->string('staff_position', 40)->nullable();
            $table->string('staff_level', 10)->nullable();
            $table->string('staff_user', 35)->nullable();
            $table->string('staff_pass', 60)->nullable();
            $table->string('staff_img', 40)->nullable();
            $table->string('staff_email', 60)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_request_staff');
    }
};
