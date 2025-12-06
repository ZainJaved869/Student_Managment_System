@extends('layouts.app')

@section('title', 'Roles & Permissions')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Roles & Permissions</h2>
        <div>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Role
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="dashboard-cards" style="margin-bottom: 30px;">
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-stats">{{ $roles->count() }}</div>
                    <div class="card-title">Total Roles</div>
                </div>
                <div class="card-icon" style="background-color: var(--primary);">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    @php
                        $totalUsers = 0;
                        foreach($roles as $role) {
                            $totalUsers += $role->users_count;
                        }
                    @endphp
                    <div class="card-stats">{{ $totalUsers }}</div>
                    <div class="card-title">Total Users</div>
                </div>
                <div class="card-icon" style="background-color: var(--success);">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-stats">{{ count($permissions) }}</div>
                    <div class="card-title">Available Permissions</div>
                </div>
                <div class="card-icon" style="background-color: var(--info);">
                    <i class="fas fa-key"></i>
                </div>
            </div>
        </div>
    </div>

    @if($roles->count() > 0)
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Role Name</th>
                    <th>Description</th>
                    <th>Permissions</th>
                    <th>Users</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar" style="width: 35px; height: 35px; font-size: 0.8rem; margin-right: 10px; background-color: var(--primary);">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <strong>{{ $role->name }}</strong>
                            @if($role->is_system)
                                <span class="badge badge-warning ml-2">System</span>
                            @endif
                        </div>
                    </td>
                    <td>{{ $role->description }}</td>
                    <td>
                        <div class="permissions-list">
                            @if(in_array('all', $role->permissions ?? []))
                                <span class="badge badge-success">All Permissions</span>
                            @else
                                @foreach(array_slice($role->permissions ?? [], 0, 3) as $permission)
                                    <span class="badge badge-primary" title="{{ $permissions[$permission] ?? $permission }}">
                                        {{ $permission }}
                                    </span>
                                @endforeach
                                @if(count($role->permissions ?? []) > 3)
                                    <span class="badge badge-secondary">
                                        +{{ count($role->permissions ?? []) - 3 }} more
                                    </span>
                                @endif
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-info">{{ $role->users_count }} users</span>
                    </td>
                    <td>{{ $role->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('roles.users', $role->id) }}" class="btn btn-sm" title="View Users">
                                <i class="fas fa-users text-info"></i>
                            </a>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm" title="Edit Role">
                                <i class="fas fa-edit text-primary"></i>
                            </a>
                            @if(!$role->is_system)
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this role?')">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-user-shield fa-4x text-muted mb-3"></i>
        <h3>No Roles Found</h3>
        <p class="text-muted">Get started by creating your first role.</p>
        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create First Role
        </a>
    </div>
    @endif

    <!-- Permissions Overview -->
    <div class="section" style="margin-top: 30px;">
        <div class="section-header">
            <h2 class="section-title">Available Permissions</h2>
        </div>
        <div class="permissions-grid">
            @foreach($permissions as $key => $description)
            <div class="permission-item">
                <div class="permission-icon">
                    <i class="fas fa-key"></i>
                </div>
                <div class="permission-info">
                    <strong>{{ $key }}</strong>
                    <p>{{ $description }}</p>
                </div>
            </div>
            @endforeach
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

.permissions-list {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.permission-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid var(--primary);
}

.permission-icon {
    width: 40px;
    height: 40px;
    background: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
}

.permission-info strong {
    display: block;
    color: var(--secondary);
}

.permission-info p {
    margin: 5px 0 0 0;
    color: #6c757d;
    font-size: 0.875rem;
}
</style>
@endsection