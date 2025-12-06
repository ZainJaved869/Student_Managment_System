@php
    $user = auth()->user();
@endphp

<div class="sidebar">
    <div class="sidebar-header">
        @if($user->profile_picture)
            <img src="{{ asset('storage/profile-pictures/' . $user->profile_picture) }}" class="sidebar-avatar" alt="Avatar">
        @else
            <div class="sidebar-avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        @endif
        <h2>{{ $user->name }}</h2>
        <p>{{ $user->role ? $user->role->name : 'No Role Assigned' }}</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
        </a>

        <div class="menu-item" id="student-management-menu">
            <i class="fas fa-user-graduate"></i><span>Student Management</span>
            <i class="fas fa-chevron-down ml-auto"></i>
        </div>
        <div class="submenu" id="student-management-submenu">
            <a href="{{ route('students.index') }}" class="submenu-item {{ request()->is('students*') && !request()->is('students/create') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Student List
            </a>
            <a href="{{ route('students.create') }}" class="submenu-item {{ request()->is('students/create') ? 'active' : '' }}">
                <i class="fas fa-plus"></i> Add Student
            </a>
        </div>

        <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i><span>Profile & Settings</span>
        </a>

        <!-- Add more menus here -->
    </div>
</div>
