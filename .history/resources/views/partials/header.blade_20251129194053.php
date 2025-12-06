<!-- Header -->
<div class="header">
    <div class="header-left">
        <h1 id="pageTitle">@yield('title', 'Dashboard Overview')</h1>
    </div>
    <div class="header-right">
        <div class="panel-selector">
            <div class="panel-btn active" data-panel="dashboard" data-sidebar="dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </div>
            <div class="panel-btn" data-panel="student" data-sidebar="student-management">
                <i class="fas fa-user-graduate"></i>
                <span>Student</span>
            </div>
            <div class="panel-btn" data-panel="staff" data-sidebar="staff-management">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Staff</span>
            </div>
            <div class="panel-btn" data-panel="admin" data-sidebar="admin-management">
                <i class="fas fa-user-shield"></i>
                <span>Admin</span>
            </div>
            <div class="panel-btn" data-panel="finance" data-sidebar="fees-management">
                <i class="fas fa-money-bill-wave"></i>
                <span>Finance</span>
            </div>
        </div>
        <div class="user-info">
            <div class="user-avatar">
                @if(auth()->check())
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                @else
                    JD
                @endif
            </div>
            <div>
                <div>{{ auth()->user()->name ?? 'John Doe' }}</div>
                <div style="font-size: 0.8rem; color: #6c757d;">{{ auth()->user()->role ?? 'Administrator' }}</div>
            </div>
        </div>
    </div>
</div>