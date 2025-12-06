<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'student_id' => 'STU-1001',
            'first_name' => 'Emma',
            'last_name' => 'Johnson',
            'email' => 'emma.j@example.com',
            'class' => '10th Grade',
            'section' => 'A',
            'parent_name' => 'Michael Johnson',
            'status' => 'active'
        ]);

        // Add more students if you want
        Student::factory()->count(10)->create(); // optional if you have a factory
    }
}
