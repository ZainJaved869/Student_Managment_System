<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Staff;
use App\Models\Fee;
use App\Models\Leave;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $stats = [
                'total_students' => Student::count(),
                'total_staff' => Staff::count(),
                'total_fees' => Fee::where('status', 'paid')->sum('amount'),
                'pending_leaves' => Leave::where('status', 'pending')->count(),
            ];

            $recentStudents = Student::latest()->take(5)->get();
            $pendingLeaves = Leave::with('applicant')->where('status', 'pending')->get();

            return view('dashboard', compact('stats', 'recentStudents', 'pendingLeaves'));
        } catch (\Exception $e) {
            // If tables don't exist yet, show empty dashboard
            $stats = [
                'total_students' => 0,
                'total_staff' => 0,
                'total_fees' => 0,
                'pending_leaves' => 0,
            ];

            $recentStudents = [];
            $pendingLeaves = [];

            return view('dashboard', compact('stats', 'recentStudents', 'pendingLeaves'))
                ->with('error', 'Database not set up yet. Please run migrations.');
        }
    }
}