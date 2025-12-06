<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->json('permissions')->nullable();
            $table->integer('users_count')->default(0);
            $table->boolean('is_system')->default(false);
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            [
                'name' => 'Administrator',
                'description' => 'Full system access with all permissions',
                'permissions' => json_encode(['all']),
                'users_count' => 1,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Principal',
                'description' => 'School principal with management access',
                'permissions' => json_encode(['dashboard', 'students', 'staff', 'fees', 'leaves', 'reports']),
                'users_count' => 1,
                'is_system' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Teacher',
                'description' => 'Teaching staff with limited access',
                'permissions' => json_encode(['dashboard', 'students', 'attendance', 'grades']),
                'users_count' => 25,
                'is_system' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Accountant',
                'description' => 'Financial management access',
                'permissions' => json_encode(['dashboard', 'fees', 'reports']),
                'users_count' => 2,
                'is_system' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Parent',
                'description' => 'Parent access to view student information',
                'permissions' => json_encode(['dashboard', 'student_info', 'attendance', 'grades']),
                'users_count' => 150,
                'is_system' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Student',
                'description' => 'Student self-service access',
                'permissions' => json_encode(['dashboard', 'profile', 'attendance', 'grades']),
                'users_count' => 500,
                'is_system' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};