@extends('layouts.app')

@section('title', 'Role Users')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Users with {{ $role['name'] }} Role</h2>
        <div>
            <a href="{{ route('roles.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
        </div>
    </div>

    <div class="section">
        <!-- Role Summary -->
        <div class="role-summary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
            <h3 style="margin: 0 0 10px 0;">{{ $role['name'] }} Role</h3>
            <p style="margin: 0; opacity: 0.9;">{{ count($users) }} users assigned to this role</p>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar" style="width: 35px; height: 35px; font-size: 0.8rem; margin-right: 10px;">
                                    {{ substr($user['name'], 0, 1) }}
                                </div>
                                {{ $user['name'] }}
                            </div>
                        </td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                            <span class="badge badge-primary">{{ $user['role'] }}</span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $user['status'] == 'active' ? 'success' : 'warning' }}">
                                {{ ucfirst($user['status']) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-sm" title="View Profile">
                                    <i class="fas fa-eye text-info"></i>
                                </button>
                                <button class="btn btn-sm" title="Edit User">
                                    <i class="fas fa-edit text-primary"></i>
                                </button>
                                <button class="btn btn-sm" title="Remove Role">
                                    <i class="fas fa-user-times text-danger"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p>No users found with this role.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add User to Role -->
        <div class="section" style="margin-top: 30px;">
            <div class="section-header">
                <h2 class="section-title">Add User to Role</h2>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Select User</label>
                            <select class="form-control">
                                <option value="">Select a user...</option>
                                <option value="1">John Doe (john.doe@school.edu)</option>
                                <option value="2">Jane Smith (jane.smith@school.edu)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success" style="margin-top: 8px;">
                                <i class="fas fa-user-plus"></i> Add User to Role
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.action-buttons {
    display: flex;
    gap: 5px;
}

.action-buttons .btn {
    padding: 5px 8px;
    border: none;
    background: none;
    cursor: pointer;
}
</style>
@endsection