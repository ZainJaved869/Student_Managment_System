<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h2>EduManage Pro</h2>
        <p>Student Management</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        
        <div class="menu-item" id="student-management-menu">
            <i class="fas fa-user-graduate"></i>
            <span>Student Management</span>
            <i class="fas fa-chevron-down ml-auto"></i>
        </div>
        <div class="submenu" id="student-management-submenu">
            <a href="{{ route('students.index') }}" class="submenu-item {{ request()->is('students*') && !request()->is('students/create') ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                <span>Student List</span>
            </a>
            <a href="{{ route('students.create') }}" class="submenu-item {{ request()->is('students/create') ? 'active' : '' }}">
                <i class="fas fa-plus"></i>
                <span>Add Student</span>
            </a>
        </div>
        
        <div class="menu-item" id="staff-management-menu">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Staff Management</span>
            <i class="fas fa-chevron-down ml-auto"></i>
        </div>
        <div class="submenu" id="staff-management-submenu">
            <a href="{{ route('staff.index') }}" class="submenu-item {{ request()->is('staff*') && !request()->is('staff/create') ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                <span>Staff List</span>
            </a>
            <a href="{{ route('staff.create') }}" class="submenu-item {{ request()->is('staff/create') ? 'active' : '' }}">
                <i class="fas fa-plus"></i>
                <span>Add Staff</span>
            </a>
        </div>
        
        <div class="menu-item" id="fees-management-menu">
            <i class="fas fa-money-bill-wave"></i>
            <span>Fees Management</span>
            <i class="fas fa-chevron-down ml-auto"></i>
        </div>
        <div class="submenu" id="fees-management-submenu">
            <a href="{{ route('fees.index') }}" class="submenu-item {{ request()->is('fees*') && !request()->is('fees/create') ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                <span>Fees Records</span>
            </a>
            <a href="{{ route('fees.create') }}" class="submenu-item {{ request()->is('fees/create') ? 'active' : '' }}">
                <i class="fas fa-plus"></i>
                <span>Collect Fees</span>
            </a>
        </div>
        
        <div class="menu-item" id="leave-management-menu">
            <i class="fas fa-calendar-alt"></i>
            <span>Leave Management</span>
            <i class="fas fa-chevron-down ml-auto"></i>
        </div>
        <div class="submenu" id="leave-management-submenu">
            <a href="{{ route('leaves.index') }}" class="submenu-item {{ request()->is('leaves*') && !request()->is('leaves/create') ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                <span>Leave Applications</span>
            </a>
            <a href="{{ route('leaves.create') }}" class="submenu-item {{ request()->is('leaves/create') ? 'active' : '' }}">
                <i class="fas fa-plus"></i>
                <span>Apply for Leave</span>
            </a>
        </div>
        
        <a href="{{ route('roles.index') }}" class="menu-item {{ request()->is('roles*') ? 'active' : '' }}">
            <i class="fas fa-user-shield"></i>
            <span>Roles & Permissions</span>
        </a>
        
        <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i>
            <span>Profile & Settings</span>
        </a>
    </div>
</div>