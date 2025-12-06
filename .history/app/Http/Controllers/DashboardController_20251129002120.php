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
        
        // Check if user exists
        if (!$user) {
            return redirect()->route('login');
        }

        $role = $user->role;
        $roleName = $role ? $role->name : 'Guest';

        // Initialize stats with default values
        $stats = [
            'total_students' => 0,
            'total_staff' => 0,
            'total_fees' => 0,
            'pending_leaves' => 0,
        ];

        // Only calculate stats if user is admin or has permission
        if ($roleName === 'Admin') {
            $stats = [
                'total_students' => Student::count(),
                'total_staff' => Staff::count(),
                'total_fees' => Fee::where('status', 'paid')->sum('amount') ?? 0,
                'pending_leaves' => Leave::where('status', 'pending')->count(),
            ];
        }

        // Role-specific data
        $roleData = $this->getRoleData($user, $roleName);

        return view('dashboard', compact('stats', 'roleData', 'user', 'roleName'));
    }

    // ... rest of the methods remain the same as previous version
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
                'total_collected' => Fee::where('status', 'paid')->sum('amount') ?? 0,
                'total_pending' => Fee::where('status', 'pending')->sum('amount') ?? 0,
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