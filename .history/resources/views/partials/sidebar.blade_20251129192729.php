@php $user = auth()->user(); @endphp

<div class="sidebar">
    <div class="sidebar-header text-center" style="padding:20px;">
        @if($user && is_object($user) && $user->profile_picture)
            <img src="{{ asset('storage/profile-pictures/' . $user->profile_picture) }}" class="sidebar-avatar" style="width:60px;height:60px;border-radius:50%;">
        @else
            <div class="sidebar-avatar-placeholder" style="width:60px;height:60px;border-radius:50%;background:#667eea;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:bold;">
                {{ $user && is_object($user) ? strtoupper(substr($user->name, 0, 1)) : '?' }}
            </div>
        @endif

        <h2>{{ $user && is_object($user) ? $user->name : 'Guest' }}</h2>
        <p>{{ $user && is_object($user) && $user->role ? $user->role->name : 'No Role Assigned' }}</p>
    </div>

    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
        </a>

        <!-- Example: Student Management -->
        <div class="menu-item" id="student-management-menu">
            <i class="fas fa-user-graduate"></i><span>Student Management</span>
            <i class="fas fa-chevron-down ml-auto"></i>
        </div>
        <div class="submenu" id="student-management-submenu">
            <a href="{{ route('students.index') }}" class="submenu-item {{ request()->is('students*') ? 'active' : '' }}">
                <i class="fas fa-list"></i><span>Student List</span>
            </a>
            <a href="{{ route('students.create') }}" class="submenu-item {{ request()->is('students/create') ? 'active' : '' }}">
                <i class="fas fa-plus"></i><span>Add Student</span>
            </a>
        </div>

        <!-- Add more menu items similarly -->
    </div>
</div>
