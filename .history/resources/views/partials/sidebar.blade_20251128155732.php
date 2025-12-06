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
        
        <div class="menu-item">
            <i class="fas fa-user-graduate"></i>
            <span>Student Management</span>
            <i class="fas fa-chevron-down ml-auto"></i>
        </div>
        <div class="submenu">
            <a href="{{ route('students.index') }}" class="submenu-item">
                <i class="fas fa-list"></i>
                <span>Student List</span>
            </a>
            <a href="{{ route('students.create') }}" class="submenu-item">
                <i class="fas fa-plus"></i>
                <span>Add Student</span>
            </a>
        </div>
        
        <!-- Similar structure for other menu items -->
    </div>
</div>