<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('email', 80)->unique();
            $table->string('phone_num', 20);
            $table->string('profile_pic_file', 60)->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->integer('verification_code')->nullable();
            $table->enum('role', ['patient', 'therapist', 'admin'])->default('patient');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
