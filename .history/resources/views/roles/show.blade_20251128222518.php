@extends('layouts.app')

@section('title', 'View Role')

@section('content')
<div class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h2 class="section-title">Role: {{ $role->name }}</h2>
        <div>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            @if(!$role->is_system)
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            @endif
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h4>Role Details</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $role->name }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $role->description }}</td>
                </tr>
                <tr>
                    <th>Users Count</th>
                    <td>{{ $role->users()->count() }} users</td>
                </tr>
                <tr>
                    <th>Permissions</th>
                    <td>
                        @php
                            $rolePermissions = $role->permissions ?? [];
                        @endphp

                        @if(in_array('all', $rolePermissions))
                            <span class="badge badge-success">All Permissions</span>
                        @elseif(!empty($rolePermissions))
                            @foreach($rolePermissions as $permission)
                                <span class="badge badge-primary">{{ $permissions[$permission] ?? $permission }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">No Permissions Assigned</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $role->created_at->format('M d, Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
