<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Staff;
use App\Models\Fee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        
        // Common stats for admin
        $stats = [
            'total_students' => Student::count(),
            'total_staff' => Staff::count(),
            'total_fees' => Fee::where('status', 'paid')->sum('amount'),
            'pending_leaves' => Leave::where('status', 'pending')->count(),
        ];

        // Role-specific data
        $roleData = [];
        
        if ($role) {
            switch ($role->name) {
                case 'Admin':
                    $roleData = $this->getAdminData();
                    break;
                case 'Student':
                    $roleData = $this->getStudentData($user);
                    break;
                case 'Staff':
                case 'Teacher':
                    $roleData = $this->getStaffData($user);
                    break;
                case 'Parent':
                    $roleData = $this->getParentData($user);
                    break;
                default:
                    $roleData = $this->getDefaultData();
            }
        }

        return view('dashboard', compact('stats', 'roleData', 'user'));
    }

    private function getAdminData()
    {
        return [
            'recent_students' => Student::latest()->take(5)->get(),
            'recent_staff' => Staff::latest()->take(5)->get(),
            'pending_approvals' => Leave::where('status', 'pending')->count(),
            'fee_summary' => [
                'total_collected' => Fee::where('status', 'paid')->sum('amount'),
                'total_pending' => Fee::where('status', 'pending')->sum('amount'),
            ]
        ];
    }

    private function getStudentData($user)
    {
        $student = Student::where('user_id', $user->id)->first();
        
        return [
            'student' => $student,
            'attendance' => $student ? $student->attendance()->latest()->take(10)->get() : collect(),
            'grades' => $student ? $student->grades()->with('subject')->get() : collect(),
            'fees' => $student ? $student->fees()->latest()->get() : collect(),
        ];
    }

    private function getStaffData($user)
    {
        $staff = Staff::where('user_id', $user->id)->first();
        
        return [
            'staff' => $staff,
            'my_students' => $staff ? $staff->students()->count() : 0,
            'pending_leaves' => Leave::where('staff_id', $staff->id ?? null)
                                   ->where('status', 'pending')
                                   ->count(),
            'today_classes' => $staff ? $staff->classes()->whereDate('date', today())->count() : 0,
        ];
    }

    private function getParentData($user)
    {
        return [
            'children' => [], // You'll need to implement parent-child relationship
            'children_count' => 0,
            'fee_due' => 0,
            'attendance_summary' => [],
        ];
    }

    private function getDefaultData()
    {
        return [
            'message' => 'Welcome to your dashboard!',
            'quick_links' => [
                ['title' => 'Update Profile', 'route' => 'profile.edit', 'icon' => 'user'],
                ['title' => 'View Settings', 'route' => 'settings.index', 'icon' => 'cog'],
            ]
        ];
    }
}