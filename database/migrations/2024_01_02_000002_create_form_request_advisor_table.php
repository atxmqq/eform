<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_request_advisor', function (Blueprint $table) {
            $table->increments('advisor_id');
            $table->string('advisorcode', 10)->nullable();
            $table->string('prefixname', 20)->nullable();
            $table->string('advisorname', 30)->nullable();
            $table->string('advisorsurname', 30)->nullable();
            $table->string('prefixnameeng', 15)->nullable();
            $table->string('advisornameeng', 30)->nullable();
            $table->string('advisorsurnameeng', 30)->nullable();
            $table->unsignedSmallInteger('facultyid')->nullable();
            $table->string('facultyname', 50)->nullable();
            $table->string('citizenid', 13)->nullable();
            $table->string('advisor_email', 50)->nullable();
            $table->dateTime('advisor_modifile')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_request_advisor');
    }
};
