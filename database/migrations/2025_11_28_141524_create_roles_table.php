<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->json('permissions')->nullable();
            $table->integer('users_count')->default(0);
            $table->boolean('is_system')->default(false);
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes here
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};