<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('role_id')->nullable(); /
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
             $table->unsignedBigInteger('role_id')->nullable();
        $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
         
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};