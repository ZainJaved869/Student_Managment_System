<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $permissions = [
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

    public function index()
    {
        $roles = Role::all();
        $permissions = $this->permissions;

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = $this->permissions;
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'required|string|max:500',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'string'
        ]);

        try {
            DB::beginTransaction();

            // Create new role
            $role = Role::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'permissions' => $validated['permissions'],
                'users_count' => 0,
                'is_system' => false
            ]);

            DB::commit();

            return redirect()->route('roles.index')
                ->with('success', 'Role "' . $validated['name'] . '" created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating role: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $this->permissions;

        return view('roles.show', compact('role', 'permissions'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        
        // Prevent editing system roles
        if ($role->is_system) {
            return redirect()->route('roles.index')
                ->with('error', 'System roles cannot be edited.');
        }

        $permissions = $this->permissions;
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Prevent editing system roles
        if ($role->is_system) {
            return redirect()->route('roles.index')
                ->with('error', 'System roles cannot be edited.');
        }

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'description' => 'required|string|max:500',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'string'
        ]);

        try {
            DB::beginTransaction();

            // Update role
            $role->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'permissions' => $validated['permissions']
            ]);

            DB::commit();

            return redirect()->route('roles.index')
                ->with('success', 'Role "' . $validated['name'] . '" updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating role: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        try {
            DB::beginTransaction();

            // Prevent deletion of system roles
            if ($role->is_system) {
                return redirect()->route('roles.index')
                    ->with('error', 'System roles cannot be deleted.');
            }

            // Prevent deletion if role has users
            if ($role->users()->count() > 0) {
                return redirect()->route('roles.index')
                    ->with('error', 'Cannot delete role that has users assigned. Please reassign users first.');
            }

            // Delete role
            $role->delete();

            DB::commit();

            return redirect()->route('roles.index')
                ->with('success', 'Role "' . $role->name . '" deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('roles.index')
                ->with('error', 'Error deleting role: ' . $e->getMessage());
        }
    }

    public function users($id)
    {
        $role = Role::findOrFail($id);
        $users = User::where('role_id', $id)->get();
        $usersWithoutRole = User::whereNull('role_id')->get();

        return view('roles.users', compact('users', 'role', 'usersWithoutRole'));
    }

    // Assign user to role
    public function assignUser(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        try {
            DB::beginTransaction();

            $user = User::findOrFail($validated['user_id']);
            $user->role_id = $role->id;
            $user->save();

            DB::commit();

            return redirect()->back()
                ->with('success', 'User assigned to role successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error assigning user to role: ' . $e->getMessage());
        }
    }

    // Remove user from role
    public function removeUser($roleId, $userId)
    {
        $role = Role::findOrFail($roleId);

        try {
            DB::beginTransaction();

            $user = User::findOrFail($userId);
            $user->role_id = null;
            $user->save();

            DB::commit();

            return redirect()->back()
                ->with('success', 'User removed from role successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error removing user from role: ' . $e->getMessage());
        }
    }
}