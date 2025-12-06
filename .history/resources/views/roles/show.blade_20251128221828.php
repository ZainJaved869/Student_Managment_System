@extends('layouts.app')

@section('title', 'View Role - ' . $role->name)

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Role Details</h2>
        <div>
            <a href="{{ route('roles.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
            @if(!$role->is_system)
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Role
                </a>
            @endif
        </div>
    </div>

    <div class="section">
        <!-- Role Information Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $role->name }}</h3>
                @if($role->is_system)
                    <span class="badge badge-warning">System Role</span>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-group">
                            <label class="info-label">Role Name:</label>
                            <span class="info-value">{{ $role->name }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-group">
                            <label class="info-label">Users Count:</label>
                            <span class="info-value badge badge-info">{{ $role->users_count }} users</span>
                        </div>
                    </div>
                </div>
                
                <div class="info-group">
                    <label class="info-label">Description:</label>
                    <p class="info-value">{{ $role->description }}</p>
                </div>

                <div class="info-group">
                    <label class="info-label">Created:</label>
                    <span class="info-value">{{ $role->created_at->format('M d, Y \a\t h:i A') }}</span>
                </div>

                @if($role->updated_at != $role->created_at)
                <div class="info-group">
                    <label class="info-label">Last Updated:</label>
                    <span class="info-value">{{ $role->updated_at->format('M d, Y \a\t h:i A') }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Permissions Card -->
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3 class="card-title">Role Permissions</h3>
                <span class="badge badge-primary">{{ count($role->permissions ?? []) }} permissions</span>
            </div>
            <div class="card-body">
                @if(in_array('all', $role->permissions ?? []))
                    <div class="alert alert-success">
                        <i class="fas fa-shield-alt"></i>
                        <strong>All Permissions Granted</strong>
                        <p class="mb-0">This role has access to all system permissions.</p>
                    </div>
                @elseif(empty($role->permissions))
                    <div class="text-center py-4">
                        <i class="fas fa-lock fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No permissions assigned to this role.</p>
                    </div>
                @else
                    <div class="permissions-grid">
                        @foreach($role->permissions as $permission)
                            @if(isset($permissions[$permission]))
                            <div class="permission-item active">
                                <div class="permission-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="permission-info">
                                    <strong>{{ $permission }}</strong>
                                    <p>{{ $permissions[$permission] }}</p>
                                </div>
                            </div>
                            @else
                            <div class="permission-item active">
                                <div class="permission-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="permission-info">
                                    <strong>{{ $permission }}</strong>
                                    <p>Custom Permission</p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Users Card -->
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3 class="card-title">Assigned Users</h3>
                <a href="{{ route('roles.users', $role->id) }}" class="btn btn-sm btn-outline-primary">
                    View All Users
                </a>
            </div>
            <div class="card-body">
                @if($role->users_count > 0)
                    <div class="users-list">
                        @foreach($role->users->take(5) as $user)
                        <div class="user-item">
                            <div class="user-avatar">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="user-info">
                                <strong>{{ $user->name }}</strong>
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="user-status">
                                <span class="badge badge-{{ $user->status == 'active' ? 'success' : 'warning' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                        
                        @if($role->users_count > 5)
                        <div class="text-center mt-3">
                            <a href="{{ route('roles.users', $role->id) }}" class="btn btn-sm btn-outline-primary">
                                View all {{ $role->users_count }} users
                            </a>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No users assigned to this role.</p>
                        <a href="{{ route('roles.users', $role->id) }}" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Assign Users
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons" style="margin-top: 20px;">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
            
            @if(!$role->is_system)
            <div style="display: inline-block;">
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Role
                </a>
                
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete this role?')"
                            {{ $role->users_count > 0 ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i> Delete Role
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.card {
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
    margin-bottom: 1rem;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
    padding: 0.75rem 1.25rem;
    display: flex;
    justify-content: between;
    align-items: center;
}

.card-title {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.card-body {
    padding: 1.25rem;
}

.info-group {
    margin-bottom: 1rem;
}

.info-label {
    font-weight: 600;
    color: #6e707e;
    display: block;
    margin-bottom: 0.25rem;
}

.info-value {
    color: #858796;
}

.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 15px;
}

.permission-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #28a745;
}

.permission-item.active {
    border-left-color: #28a745;
}

.permission-icon {
    width: 40px;
    height: 40px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
}

.permission-info strong {
    display: block;
    color: #2e59d9;
    font-weight: 600;
}

.permission-info p {
    margin: 5px 0 0 0;
    color: #6c757d;
    font-size: 0.875rem;
}

.users-list {
    max-height: 300px;
    overflow-y: auto;
}

.user-item {
    display: flex;
    align-items: center;
    padding: 12px;
    border: 1px solid #e3e6f0;
    border-radius: 6px;
    margin-bottom: 10px;
    background: #fff;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #2e59d9;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 15px;
}

.user-info {
    flex: 1;
}

.user-info strong {
    display: block;
    color: #2e59d9;
}

.user-info span {
    color: #6c757d;
    font-size: 0.875rem;
}

.user-status {
    margin-left: auto;
}

.action-buttons {
    display: flex;
    justify-content: between;
    align-items: center;
    gap: 10px;
}

.badge {
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 600;
}

.alert {
    border-radius: 0.35rem;
    padding: 1rem 1.25rem;
}

.alert-success {
    background-color: #d1e7dd;
    border-color: #badbcc;
    color: #0f5132;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add any JavaScript functionality here if needed
});
</script>
@endsection