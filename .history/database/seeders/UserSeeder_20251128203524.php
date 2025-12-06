<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'Administrator')->first();
        $teacherRole = Role::where('name', 'Teacher')->first();
        $studentRole = Role::where('name', 'Student')->first();
        
        // Create admin user
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@school.edu',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'status' => 'active'
        ]);

        // Create teacher user
        User::create([
            'name' => 'John Teacher',
            'email' => 'teacher@school.edu',
            'password' => Hash::make('password'),
            'role_id' => $teacherRole->id,
            'status' => 'active'
        ]);

        // Create student user
        User::create([
            'name' => 'Jane Student',
            'email' => 'student@school.edu',
            'password' => Hash::make('password'),
            'role_id' => $studentRole->id,
            'status' => 'active'
        ]);

        // Create users without roles
        User::create([
            'name' => 'Michael Johnson',
            'email' => 'michael@school.edu',
            'password' => Hash::make('password'),
            'role_id' => null,
            'status' => 'active'
        ]);

        User::create([
            'name' => 'Sarah Wilson',
            'email' => 'sarah@school.edu',
            'password' => Hash::make('password'),
            'role_id' => null,
            'status' => 'active'
        ]);

        User::create([
            'name' => 'Robert Brown',
            'email' => 'robert@school.edu',
            'password' => Hash::make('password'),
            'role_id' => null,
            'status' => 'active'
        ]);
    }
}