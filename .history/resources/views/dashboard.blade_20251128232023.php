@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Role-based Dashboard -->
<div class="dashboard-container">
    @if($roleName == 'Admin')
    <!-- Admin Dashboard -->
    <div class="admin-dashboard">
        <!-- Header Section -->
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title">Admin Dashboard</h1>
                <p class="dashboard-subtitle">Overview of your institution's performance</p>
            </div>
            <div class="header-actions">
                <div class="current-period">
                    <i class="fas fa-calendar-alt"></i>
                    {{ now()->format('F Y') }}
                </div>
            </div>
        </div>

        <!-- Key Metrics Grid -->
        <div class="metrics-grid">
            <div class="metric-card metric-primary">
                <div class="metric-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $stats['total_students'] }}</div>
                    <div class="metric-label">Total Students</div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        12% increase
                    </div>
                </div>
                <a href="{{ route('students.index') }}" class="metric-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="metric-card metric-info">
                <div class="metric-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $stats['total_staff'] }}</div>
                    <div class="metric-label">Teaching Staff</div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        5% increase
                    </div>
                </div>
                <a href="{{ route('staff.index') }}" class="metric-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="metric-card metric-success">
                <div class="metric-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">${{ number_format($stats['total_fees'], 2) }}</div>
                    <div class="metric-label">Fees Collected</div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        18% increase
                    </div>
                </div>
                <a href="{{ route('fees.index') }}" class="metric-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="metric-card metric-warning">
                <div class="metric-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $stats['pending_leaves'] }}</div>
                    <div class="metric-label">Pending Leaves</div>
                    <div class="metric-trend negative">
                        <i class="fas fa-arrow-down"></i>
                        3% decrease
                    </div>
                </div>
                <a href="{{ route('leaves.index') }}" class="metric-action">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="dashboard-content-grid">
            <!-- Quick Actions -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                    <span class="card-subtitle">Frequently used operations</span>
                </div>
                <div class="card-body">
                    <div class="quick-actions-grid">
                        <a href="{{ route('students.create') }}" class="action-item">
                            <div class="action-icon bg-success">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title">Add Student</div>
                                <div class="action-desc">Register new student</div>
                            </div>
                            <div class="action-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>

                        <a href="{{ route('staff.create') }}" class="action-item">
                            <div class="action-icon bg-info">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title">Add Staff</div>
                                <div class="action-desc">Create staff member</div>
                            </div>
                            <div class="action-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>

                        <a href="{{ route('fees.create') }}" class="action-item">
                            <div class="action-icon bg-warning">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title">Collect Fee</div>
                                <div class="action-desc">Record payment</div>
                            </div>
                            <div class="action-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>

                        <a href="{{ route('roles.index') }}" class="action-item">
                            <div class="action-icon bg-primary">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title">Manage Roles</div>
                                <div class="action-desc">User permissions</div>
                            </div>
                            <div class="action-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Students -->
            @if(isset($roleData['recent_students']) && $roleData['recent_students']->count() > 0)
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Recent Students</h3>
                    <span class="card-subtitle">Newly registered students</span>
                </div>
                <div class="card-body">
                    <div class="recent-list">
                        @foreach($roleData['recent_students'] as $student)
                        <div class="recent-item">
                            <div class="student-avatar">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <div class="student-info">
                                <div class="student-name">{{ $student->name }}</div>
                                <div class="student-details">{{ $student->grade }} • {{ $student->section }}</div>
                            </div>
                            <div class="student-meta">
                                <span class="time-ago">{{ $student->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Financial Overview -->
        @if(isset($roleData['fee_summary']))
        <div class="content-card full-width">
            <div class="card-header">
                <h3 class="card-title">Financial Overview</h3>
                <span class="card-subtitle">Fee collection summary</span>
            </div>
            <div class="card-body">
                <div class="financial-grid">
                    <div class="financial-item">
                        <div class="financial-value text-success">${{ number_format($roleData['fee_summary']['total_collected'] ?? 0, 2) }}</div>
                        <div class="financial-label">Total Collected</div>
                        <div class="financial-badge success">On Track</div>
                    </div>
                    <div class="financial-item">
                        <div class="financial-value text-warning">${{ number_format($roleData['fee_summary']['total_pending'] ?? 0, 2) }}</div>
                        <div class="financial-label">Pending Collection</div>
                        <div class="financial-badge warning">Action Required</div>
                    </div>
                    <div class="financial-item">
                        <div class="financial-value text-info">85%</div>
                        <div class="financial-label">Collection Rate</div>
                        <div class="financial-badge info">Good</div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    @elseif($roleName == 'Student')
    <!-- Student Dashboard -->
    <div class="student-dashboard">
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title">Welcome back, {{ $user->name }}!</h1>
                <p class="dashboard-subtitle">Here's your academic overview</p>
            </div>
            <div class="student-badge">
                <span class="badge badge-primary">Student</span>
            </div>
        </div>

        @if(isset($roleData['has_profile']) && $roleData['has_profile'])
        <div class="metrics-grid">
            <div class="metric-card metric-info">
                <div class="metric-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $roleData['attendance']->count() }}</div>
                    <div class="metric-label">Attendance Records</div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        95% attendance
                    </div>
                </div>
            </div>

            <div class="metric-card metric-success">
                <div class="metric-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $roleData['grades']->count() }}</div>
                    <div class="metric-label">Enrolled Subjects</div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        All active
                    </div>
                </div>
            </div>

            <div class="metric-card metric-warning">
                <div class="metric-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $roleData['fees']->where('status', 'pending')->count() }}</div>
                    <div class="metric-label">Pending Fees</div>
                    <div class="metric-trend negative">
                        <i class="fas fa-exclamation-circle"></i>
                        Payment due
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert-card warning">
            <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="alert-content">
                <h4>Profile Not Found</h4>
                <p>{{ $roleData['message'] ?? 'Student profile not found. Please contact administrator.' }}</p>
            </div>
        </div>
        @endif
    </div>

    @elseif($roleName == 'Staff' || $roleName == 'Teacher')
    <!-- Staff Dashboard -->
    <div class="staff-dashboard">
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title">Staff Dashboard</h1>
                <p class="dashboard-subtitle">Teaching and management overview</p>
            </div>
            <div class="staff-badge">
                <span class="badge badge-info">{{ $roleName }}</span>
            </div>
        </div>

        @if(isset($roleData['has_profile']) && $roleData['has_profile'])
        <div class="metrics-grid">
            <div class="metric-card metric-primary">
                <div class="metric-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $roleData['my_students'] ?? 0 }}</div>
                    <div class="metric-label">My Students</div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        Active
                    </div>
                </div>
            </div>

            <div class="metric-card metric-info">
                <div class="metric-icon">
                    <i class="fas fa-chalkboard"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $roleData['today_classes'] ?? 0 }}</div>
                    <div class="metric-label">Today's Classes</div>
                    <div class="metric-trend neutral">
                        <i class="fas fa-minus"></i>
                        Scheduled
                    </div>
                </div>
            </div>

            <div class="metric-card metric-warning">
                <div class="metric-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $roleData['pending_leaves'] ?? 0 }}</div>
                    <div class="metric-label">Pending Leaves</div>
                    <div class="metric-trend negative">
                        <i class="fas fa-clock"></i>
                        Awaiting approval
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert-card warning">
            <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="alert-content">
                <h4>Profile Not Found</h4>
                <p>{{ $roleData['message'] ?? 'Staff profile not found. Please contact administrator.' }}</p>
            </div>
        </div>
        @endif
    </div>

    @else
    <!-- Default Dashboard -->
    <div class="default-dashboard">
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title">Welcome to Student Management System</h1>
                <p class="dashboard-subtitle">Getting started with your account</p>
            </div>
        </div>

        <div class="alert-card info">
            <div class="alert-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="alert-content">
                <h4>Welcome, {{ $user->name }}!</h4>
                <p>
                    @if($roleName == 'Guest')
                    You currently don't have a specific role assigned. Please contact administrator for role assignment.
                    @else
                    Your role is <strong>{{ $roleName }}</strong>. You can access features based on your permissions.
                    @endif
                </p>
            </div>
        </div>

        @if(isset($roleData['message']))
        <div class="alert-card warning">
            <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="alert-content">
                <h4>Notice</h4>
                <p>{{ $roleData['message'] }}</p>
            </div>
        </div>
        @endif

        <div class="quick-access-grid">
            <a href="{{ route('profile.show') }}" class="access-card">
                <div class="access-icon bg-primary">
                    <i class="fas fa-user"></i>
                </div>
                <div class="access-content">
                    <h3>My Profile</h3>
                    <p>View and update your personal information</p>
                </div>
                <div class="access-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <a href="{{ route('settings.index') }}" class="access-card">
                <div class="access-icon bg-info">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="access-content">
                    <h3>Settings</h3>
                    <p>Configure system preferences</p>
                </div>
                <div class="access-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            @if(Auth::user()->role && Auth::user()->role->name == 'Admin')
            <a href="{{ route('roles.users', Auth::user()->role->id) }}" class="access-card">
                <div class="access-icon bg-success">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="access-content">
                    <h3>Manage Roles</h3>
                    <p>User permissions and access control</p>
                </div>
                <div class="access-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
            @endif
        </div>
    </div>
    @endif
</div>

<style>
.dashboard-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Header Styles */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
}

.dashboard-title {
    font-size: 2.25rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.dashboard-subtitle {
    color: #64748b;
    font-size: 1.1rem;
    margin: 0;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.current-period {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    color: #475569;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Metrics Grid */
.metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.metric-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
    transition: all 0.3s ease;
}

.metric-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.metric-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.metric-primary .metric-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.metric-info .metric-icon { background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%); }
.metric-success .metric-icon { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
.metric-warning .metric-icon { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }

.metric-content {
    flex: 1;
}

.metric-value {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.metric-label {
    color: #64748b;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.metric-trend {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
}

.metric-trend.positive {
    background: #dcfce7;
    color: #166534;
}

.metric-trend.negative {
    background: #fef2f2;
    color: #dc2626;
}

.metric-trend.neutral {
    background: #f3f4f6;
    color: #6b7280;
}

.metric-action {
    color: #94a3b8;
    transition: color 0.3s ease;
}

.metric-action:hover {
    color: #475569;
}

/* Content Grid */
.dashboard-content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.content-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

.content-card.full-width {
    grid-column: 1 / -1;
}

.card-header {
    padding: 1.5rem 1.5rem 1rem;
    border-bottom: 1px solid #f1f5f9;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 0.25rem 0;
}

.card-subtitle {
    color: #64748b;
    font-size: 0.875rem;
    margin: 0;
}

.card-body {
    padding: 1.5rem;
}

/* Quick Actions */
.quick-actions-grid {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.action-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    border: 1px solid transparent;
}

.action-item:hover {
    background: #f8fafc;
    border-color: #e2e8f0;
    transform: translateX(4px);
}

.action-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.action-content {
    flex: 1;
}

.action-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.action-desc {
    color: #64748b;
    font-size: 0.875rem;
}

.action-arrow {
    color: #cbd5e1;
    transition: color 0.3s ease;
}

.action-item:hover .action-arrow {
    color: #64748b;
}

/* Recent List */
.recent-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.recent-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 12px;
    transition: background 0.3s ease;
}

.recent-item:hover {
    background: #f8fafc;
}

.student-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.student-info {
    flex: 1;
}

.student-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.student-details {
    color: #64748b;
    font-size: 0.875rem;
}

.student-meta {
    text-align: right;
}

.time-ago {
    color: #94a3b8;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Financial Grid */
.financial-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
}

.financial-item {
    text-align: center;
    padding: 1.5rem;
}

.financial-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.financial-label {
    color: #64748b;
    margin-bottom: 0.75rem;
    font-weight: 500;
}

.financial-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.financial-badge.success {
    background: #dcfce7;
    color: #166534;
}

.financial-badge.warning {
    background: #fef3c7;
    color: #92400e;
}

.financial-badge.info {
    background: #dbeafe;
    color: #1e40af;
}

/* Alert Cards */
.alert-card {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
}

.alert-card.info {
    background: #dbeafe;
    border: 1px solid #bfdbfe;
    color: #1e40af;
}

.alert-card.warning {
    background: #fef3c7;
    border: 1px solid #fde68a;
    color: #92400e;
}

.alert-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
}

.alert-content h4 {
    margin: 0 0 0.5rem 0;
    font-weight: 600;
}

.alert-content p {
    margin: 0;
    line-height: 1.5;
}

/* Quick Access Grid */
.quick-access-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.access-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid #e2e8f0;
    text-decoration: none;
    color: inherit;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.access-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.access-icon {
    width: 64px;
    height: 64px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.access-content {
    flex: 1;
}

.access-content h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
}

.access-content p {
    color: #64748b;
    margin: 0;
    line-height: 1.5;
}

.access-arrow {
    color: #cbd5e1;
    font-size: 1.25rem;
    transition: color 0.3s ease;
}

.access-card:hover .access-arrow {
    color: #475569;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .dashboard-content-grid {
        grid-template-columns: 1fr;
    }
    
    .metrics-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }
    
    .dashboard-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .dashboard-title {
        font-size: 1.75rem;
    }
    
    .metrics-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-access-grid {
        grid-template-columns: 1fr;
    }
    
    .financial-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

/* Utility Classes */
.bg-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.bg-info { background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%); }
.bg-success { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
.bg-warning { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }

.text-success { color: #059669; }
.text-warning { color: #d97706; }
.text-info { color: #3b82f6; }

.badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.badge-primary { background: #e0e7ff; color: #3730a3; }
.badge-info { background: #dbeafe; color: #1e40af; }
</style>
@endsection