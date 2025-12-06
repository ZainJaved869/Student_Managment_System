<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Fee;
use App\Models\Leave;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Sample Students
        $student1 = Student::create([
            'student_id' => 'STU-1001',
            'first_name' => 'Emma',
            'last_name' => 'Johnson',
            'email' => 'emma.j@example.com',
            'phone' => '123-456-7890',
            'class' => '10th Grade',
            'section' => 'A',
            'parent_name' => 'Michael Johnson',
            'parent_phone' => '123-456-7891',
            'date_of_birth' => '2007-05-15',
            'status' => 'active'
        ]);

        $student2 = Student::create([
            'student_id' => 'STU-1002',
            'first_name' => 'Noah',
            'last_name' => 'Williams',
            'email' => 'noah.w@example.com',
            'phone' => '123-456-7892',
            'class' => '9th Grade',
            'section' => 'B',
            'parent_name' => 'James Williams',
            'parent_phone' => '123-456-7893',
            'date_of_birth' => '2008-08-22',
            'status' => 'active'
        ]);

        // Create Sample Staff
        $staff1 = Staff::create([
            'staff_id' => 'STF-1001',
            'first_name' => 'Sarah',
            'last_name' => 'Miller',
            'email' => 'sarah.m@example.com',
            'phone' => '123-456-7894',
            'department' => 'Mathematics',
            'position' => 'Teacher',
            'qualification' => 'M.Sc. Mathematics',
            'salary' => 50000.00,
            'date_of_joining' => '2020-01-15',
            'status' => 'active'
        ]);

        $staff2 = Staff::create([
            'staff_id' => 'STF-1002',
            'first_name' => 'Robert',
            'last_name' => 'Brown',
            'email' => 'robert.b@example.com',
            'phone' => '123-456-7895',
            'department' => 'Science',
            'position' => 'Lab Assistant',
            'qualification' => 'B.Sc. Physics',
            'salary' => 35000.00,
            'date_of_joining' => '2021-03-10',
            'status' => 'active'
        ]);

        // Create Sample Fees
        Fee::create([
            'student_id' => $student1->id,
            'amount' => 450.00,
            'due_date' => '2024-01-15',
            'status' => 'pending'
        ]);

        Fee::create([
            'student_id' => $student2->id,
            'amount' => 450.00,
            'due_date' => '2024-01-15',
            'paid_date' => '2024-01-10',
            'payment_method' => 'Credit Card',
            'status' => 'paid'
        ]);

        // Create Sample Leaves
        Leave::create([
            'applicant_id' => $staff1->id,
            'applicant_type' => Staff::class,
            'leave_type' => 'Sick Leave',
            'start_date' => '2024-01-15',
            'end_date' => '2024-01-17',
            'reason' => 'Medical appointment',
            'status' => 'pending'
        ]);

        Leave::create([
            'applicant_id' => $student1->id,
            'applicant_type' => Student::class,
            'leave_type' => 'Personal Leave',
            'start_date' => '2024-01-20',
            'end_date' => '2024-01-21',
            'reason' => 'Family function',
            'status' => 'pending'
        ]);
    }
}