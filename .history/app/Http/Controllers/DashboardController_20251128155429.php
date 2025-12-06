

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
        $stats = [
            'total_students' => Student::count(),
            'total_staff' => Staff::count(),
            'total_fees' => Fee::where('status', 'paid')->sum('amount'),
            'pending_leaves' => Leave::where('status', 'pending')->count(),
        ];

        $recentStudents = Student::latest()->take(5)->get();
        $pendingLeaves = Leave::with('applicant')->where('status', 'pending')->get();

        return view('dashboard', compact('stats', 'recentStudents', 'pendingLeaves'));
    }
}