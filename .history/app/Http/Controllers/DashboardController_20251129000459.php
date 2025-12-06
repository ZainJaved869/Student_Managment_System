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
        
        // Check if user exists and has a role
        if (!$user) {
            return redirect()->route('login');
        }

        $role = $user->role;
        $roleName = $role ? $role->name : 'Guest';

        // Common stats for admin
        $stats = [
            'total_students' => Student::count(),
            'total_staff' => Staff::count(),
            'total_fees' => Fee::where('status', 'paid')->sum('amount'),
            'pending_leaves' => Leave::where('status', 'pending')->count(),
        ];

        // Role-specific data
        $roleData = $this->getRoleData($user, $roleName);

        return view('dashboard', compact('stats', 'roleData', 'user', 'roleName'));
    }

    private function getRoleData($user, $roleName)
    {
        switch ($roleName) {
            case 'Admin':
                return $this->getAdminData();
            case 'Student':
                return $this->getStudentData($user);
            case 'Staff':
            case 'Teacher':
                return $this->getStaffData($user);
            case 'Parent':
                return $this->getParentData($user);
            default:
                return $this->getDefaultData($user);
        }
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
        
        if (!$student) {
            return [
                'message' => 'Student profile not found. Please contact administrator.',
                'has_profile' => false
            ];
        }

        return [
            'student' => $student,
            'attendance' => $student->attendance()->latest()->take(10)->get(),
            'grades' => $student->grades()->with('subject')->get(),
            'fees' => $student->fees()->latest()->get(),
            'has_profile' => true
        ];
    }

    private function getStaffData($user)
    {
        $staff = Staff::where('user_id', $user->id)->first();
        
        if (!$staff) {
            return [
                'message' => 'Staff profile not found. Please contact administrator.',
                'has_profile' => false
            ];
        }

        return [
            'staff' => $staff,
            'my_students' => $staff->students()->count(),
            'pending_leaves' => Leave::where('staff_id', $staff->id)
                                   ->where('status', 'pending')
                                   ->count(),
            'today_classes' => $staff->classes()->whereDate('date', today())->count(),
            'has_profile' => true
        ];
    }

    private function getParentData($user)
    {
        return [
            'children' => [],
            'children_count' => 0,
            'fee_due' => 0,
            'attendance_summary' => [],
            'has_profile' => false,
            'message' => 'Parent functionality coming soon.'
        ];
    }

    private function getDefaultData($user)
    {
        return [
            'message' => 'Welcome to your dashboard! You currently don\'t have a specific role assigned.',
            'has_profile' => false,
            'quick_links' => [
                ['title' => 'Update Profile', 'route' => 'profile.edit', 'icon' => 'user'],
                ['title' => 'View Settings', 'route' => 'settings.index', 'icon' => 'cog'],
            ]
        ];
    }
}