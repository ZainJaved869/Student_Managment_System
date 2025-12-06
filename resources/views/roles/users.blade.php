@extends('layouts.app')

@section('title', 'Role Users')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Users with {{ $role->name }} Role</h2>
        <div>
            <a href="{{ route('roles.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
        </div>
    </div>

    <div class="section">
        <!-- Role Summary -->
        <div class="role-summary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
            <h3 style="margin: 0 0 10px 0;">{{ $role->name }} Role</h3>
            <p style="margin: 0; opacity: 0.9;">{{ $users->count() }} users assigned to this role</p>
        </div>

        @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Join Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar" style="width: 35px; height: 35px; font-size: 0.8rem; margin-right: 10px;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                {{ $user->name }}
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-primary">{{ $role->name }}</span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $user->status == 'active' ? 'success' : 'warning' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('roles.removeUser', ['roleId' => $role->id, 'userId' => $user->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" title="Remove from Role" onclick="return confirm('Are you sure you want to remove {{ $user->name }} from this role?')">
                                        <i class="fas fa-user-times text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-users fa-3x text-muted mb-3"></i>
            <h3>No Users Found</h3>
            <p class="text-muted">No users are currently assigned to this role.</p>
        </div>
        @endif

        <!-- Add User to Role -->
        <div class="section" style="margin-top: 30px;">
            <div class="section-header">
                <h2 class="section-title">Add User to Role</h2>
            </div>
            <form action="{{ route('roles.assignUser', $role->id) }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Select User</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">Select a user...</option>
                                @foreach($usersWithoutRole as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @if($usersWithoutRole->isEmpty())
                                <small class="text-muted">No users available without roles.</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success" style="margin-top: 8px;" {{ $usersWithoutRole->isEmpty() ? 'disabled' : '' }}>
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

.role-summary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
}
</style>
@endsection