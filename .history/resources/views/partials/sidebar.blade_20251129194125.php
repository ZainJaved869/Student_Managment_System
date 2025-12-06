<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h2>EduManage Pro</h2>
        <p id="sidebarSubtitle">Dashboard</p>
    </div>
    <div class="sidebar-menu">
        <!-- Dashboard Panel -->
        <div class="panel-content active" id="dashboard-panel">
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->is('/') || request()->is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('analytics') }}" class="menu-item {{ request()->is('analytics*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Analytics</span>
            </a>
            
            <a href="{{ route('reports') }}" class="menu-item {{ request()->is('reports*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Reports</span>
            </a>
            
            <a href="{{ route('calendar') }}" class="menu-item {{ request()->is('calendar*') ? 'active' : '' }}">
                <i class="fas fa-calendar"></i>
                <span>Calendar</span>
            </a>
        </div>

        <!-- Student Management Panel -->
        <div class="panel-content" id="student-management-panel">
            <div class="menu-item" id="student-main-menu">
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
                <a href="{{ route('students.attendance') }}" class="submenu-item {{ request()->is('attendance/students*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Attendance</span>
                </a>
                <a href="{{ route('students.grades') }}" class="submenu-item {{ request()->is('grades*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Grades & Results</span>
                </a>
                <a href="{{ route('students.fees') }}" class="submenu-item {{ request()->is('fees/students*') ? 'active' : '' }}">
                    <i class="fas fa-money-bill"></i>
                    <span>Fee Management</span>
                </a>
            </div>
            
            <a href="{{ route('classes.index') }}" class="menu-item {{ request()->is('classes*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Class Management</span>
            </a>
            
            <a href="{{ route('subjects.index') }}" class="menu-item {{ request()->is('subjects*') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                <span>Subjects</span>
            </a>
        </div>

        <!-- Staff Management Panel -->
        <div class="panel-content" id="staff-management-panel">
            <div class="menu-item" id="staff-main-menu">
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
                <a href="{{ route('staff.attendance') }}" class="submenu-item {{ request()->is('attendance/staff*') ? 'active' : '' }}">
                    <i class="fas fa-user-check"></i>
                    <span>Staff Attendance</span>
                </a>
                <a href="{{ route('staff.salary') }}" class="submenu-item {{ request()->is('salary*') ? 'active' : '' }}">
                    <i class="fas fa-money-bill"></i>
                    <span>Salary Management</span>
                </a>
            </div>
            
            <a href="{{ route('departments.index') }}" class="menu-item {{ request()->is('departments*') ? 'active' : '' }}">
                <i class="fas fa-sitemap"></i>
                <span>Departments</span>
            </a>
            
            <a href="{{ route('designations.index') }}" class="menu-item {{ request()->is('designations*') ? 'active' : '' }}">
                <i class="fas fa-user-tag"></i>
                <span>Designations</span>
            </a>
        </div>

        <!-- Admin Management Panel -->
        <div class="panel-content" id="admin-management-panel">
            <div class="menu-item" id="admin-main-menu">
                <i class="fas fa-user-shield"></i>
                <span>Admin Management</span>
                <i class="fas fa-chevron-down ml-auto"></i>
            </div>
            <div class="submenu" id="admin-management-submenu">
                <a href="{{ route('admins.index') }}" class="submenu-item {{ request()->is('admins*') && !request()->is('admins/create') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>
                    <span>Admin List</span>
                </a>
                <a href="{{ route('admins.create') }}" class="submenu-item {{ request()->is('admins/create') ? 'active' : '' }}">
                    <i class="fas fa-plus"></i>
                    <span>Add Admin</span>
                </a>
                <a href="{{ route('users.index') }}" class="submenu-item {{ request()->is('users*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>User Accounts</span>
                </a>
            </div>
            
            <a href="{{ route('roles.index') }}" class="menu-item {{ request()->is('roles*') ? 'active' : '' }}">
                <i class="fas fa-user-tag"></i>
                <span>Roles & Permissions</span>
            </a>
            
            <a href="{{ route('system.logs') }}" class="menu-item {{ request()->is('logs*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span>System Logs</span>
            </a>
            
            <a href="{{ route('backup') }}" class="menu-item {{ request()->is('backup*') ? 'active' : '' }}">
                <i class="fas fa-database"></i>
                <span>Backup & Restore</span>
            </a>
        </div>

        <!-- Finance Management Panel -->
        <div class="panel-content" id="finance-management-panel">
            <div class="menu-item" id="finance-main-menu">
                <i class="fas fa-money-bill-wave"></i>
                <span>Finance Management</span>
                <i class="fas fa-chevron-down ml-auto"></i>
            </div>
            <div class="submenu" id="finance-management-submenu">
                <a href="{{ route('fees.index') }}" class="submenu-item {{ request()->is('fees*') && !request()->is('fees/create') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>
                    <span>Fees Records</span>
                </a>
                <a href="{{ route('fees.create') }}" class="submenu-item {{ request()->is('fees/create') ? 'active' : '' }}">
                    <i class="fas fa-plus"></i>
                    <span>Collect Fees</span>
                </a>
                <a href="{{ route('expenses.index') }}" class="submenu-item {{ request()->is('expenses*') ? 'active' : '' }}">
                    <i class="fas fa-receipt"></i>
                    <span>Expenses</span>
                </a>
                <a href="{{ route('invoices.index') }}" class="submenu-item {{ request()->is('invoices*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice"></i>
                    <span>Invoices</span>
                </a>
            </div>
            
            <a href="{{ route('payroll.index') }}" class="menu-item {{ request()->is('payroll*') ? 'active' : '' }}">
                <i class="fas fa-money-check"></i>
                <span>Payroll</span>
            </a>
            
            <a href="{{ route('reports.finance') }}" class="menu-item {{ request()->is('reports/finance*') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>Financial Reports</span>
            </a>
        </div>

        <!-- Common Links (Always Visible) -->
        <div class="common-links">
            <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i>
                <span>Profile & Settings</span>
            </a>
            
            <a href="{{ route('help') }}" class="menu-item {{ request()->is('help*') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i>
                <span>Help & Support</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="menu-item logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>