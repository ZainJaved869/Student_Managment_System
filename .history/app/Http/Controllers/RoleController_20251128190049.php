<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        // Sample roles data - in a real application, this would come from a database
        $roles = [
            [
                'id' => 1,
                'name' => 'Administrator',
                'description' => 'Full system access with all permissions',
                'permissions' => ['all'],
                'users_count' => 1,
                'created_at' => '2024-01-01'
            ],
            [
                'id' => 2,
                'name' => 'Principal',
                'description' => 'School principal with management access',
                'permissions' => ['dashboard', 'students', 'staff', 'fees', 'leaves', 'reports'],
                'users_count' => 1,
                'created_at' => '2024-01-01'
            ],
            [
                'id' => 3,
                'name' => 'Teacher',
                'description' => 'Teaching staff with limited access',
                'permissions' => ['dashboard', 'students', 'attendance', 'grades'],
                'users_count' => 25,
                'created_at' => '2024-01-01'
            ],
            [
                'id' => 4,
                'name' => 'Accountant',
                'description' => 'Financial management access',
                'permissions' => ['dashboard', 'fees', 'reports'],
                'users_count' => 2,
                'created_at' => '2024-01-01'
            ],
            [
                'id' => 5,
                'name' => 'Parent',
                'description' => 'Parent access to view student information',
                'permissions' => ['dashboard', 'student_info', 'attendance', 'grades'],
                'users_count' => 150,
                'created_at' => '2024-01-01'
            ],
            [
                'id' => 6,
                'name' => 'Student',
                'description' => 'Student self-service access',
                'permissions' => ['dashboard', 'profile', 'attendance', 'grades'],
                'users_count' => 500,
                'created_at' => '2024-01-01'
            ]
        ];

        $permissions = [
            'dashboard' => 'Access Dashboard',
            'students' => 'Manage Students',
            'staff' => 'Manage Staff',
            'fees' => 'Manage Fees',
            'leaves' => 'Manage Leaves',
            'attendance' => 'Manage Attendance',
            'grades' => 'Manage Grades',
            'reports' => 'View Reports',
            'settings' => 'System Settings',
            'student_info' => 'View Student Information',
            'profile' => 'Manage Profile',
            'all' => 'All Permissions'
        ];

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = [
            'dashboard' => 'Access Dashboard',
            'students' => 'Manage Students',
            'staff' => 'Manage Staff',
            'fees' => 'Manage Fees',
            'leaves' => 'Manage Leaves',
            'attendance' => 'Manage Attendance',
            'grades' => 'Manage Grades',
            'reports' => 'View Reports',
            'settings' => 'System Settings',
            'student_info' => 'View Student Information',
            'profile' => 'Manage Profile'
        ];

        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'required|string|max:500',
            'permissions' => 'required|array',
            'permissions.*' => 'string'
        ]);

        try {
            // In a real application, you would save to database here
            // For now, we'll just redirect with success message
            
            return redirect()->route('roles.index')
                ->with('success', 'Role created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating role: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        // Sample role data - in real app, fetch from database
        $role = [
            'id' => $id,
            'name' => 'Sample Role',
            'description' => 'Sample role description',
            'permissions' => ['dashboard', 'students']
        ];

        $permissions = [
            'dashboard' => 'Access Dashboard',
            'students' => 'Manage Students',
            'staff' => 'Manage Staff',
            'fees' => 'Manage Fees',
            'leaves' => 'Manage Leaves',
            'attendance' => 'Manage Attendance',
            'grades' => 'Manage Grades',
            'reports' => 'View Reports',
            'settings' => 'System Settings',
            'student_info' => 'View Student Information',
            'profile' => 'Manage Profile'
        ];

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'description' => 'required|string|max:500',
            'permissions' => 'required|array',
            'permissions.*' => 'string'
        ]);

        try {
            // In a real application, you would update in database here
            
            return redirect()->route('roles.index')
                ->with('success', 'Role updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating role: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            // In a real application, you would delete from database here
            
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('roles.index')
                ->with('error', 'Error deleting role: ' . $e->getMessage());
        }
    }

    // User Management for Roles
    public function users($id)
    {
        // Sample users data for the role
        $users = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john.doe@school.edu',
                'role' => 'Administrator',
                'status' => 'active'
            ],
            [
                'id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane.smith@school.edu',
                'role' => 'Teacher',
                'status' => 'active'
            ]
        ];

        $role = [
            'id' => $id,
            'name' => 'Administrator'
        ];

        return view('roles.users', compact('users', 'role'));
    }
}