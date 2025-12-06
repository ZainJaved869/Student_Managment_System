@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Role-based Dashboard -->
@if($roleName == 'Admin')
    <!-- Admin Dashboard -->
    <div class="panel-content active" id="admin-panel">
        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <div class="card card-students">
                <div class="card-header">
                    <div>
                        <div class="card-stats">{{ $stats['total_students'] }}</div>
                        <div class="card-title">Total Students</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
                <a href="{{ route('students.index') }}" class="card-footer">
                    View All Students <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="card card-staff">
                <div class="card-header">
                    <div>
                        <div class="card-stats">{{ $stats['total_staff'] }}</div>
                        <div class="card-title">Teaching Staff</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
                <a href="{{ route('staff.index') }}" class="card-footer">
                    Manage Staff <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="card card-fees">
                <div class="card-header">
                    <div>
                        <div class="card-stats">${{ number_format($stats['total_fees'], 2) }}</div>
                        <div class="card-title">Fees Collected</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
                <a href="{{ route('fees.index') }}" class="card-footer">
                    Fee Reports <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="card card-leaves">
                <div class="card-header">
                    <div>
                        <div class="card-stats">{{ $stats['pending_leaves'] }}</div>
                        <div class="card-title">Pending Leaves</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
                <a href="{{ route('leaves.index') }}" class="card-footer">
                    Manage Leaves <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Quick Actions</h2>
            </div>
            <div class="dashboard-cards">
                <a href="{{ route('students.create') }}" class="card quick-action-card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">Add Student</div>
                            <div class="card-title">Register new student</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--success);">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('staff.create') }}" class="card quick-action-card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">Add Staff</div>
                            <div class="card-title">Create new staff member</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--info);">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('fees.create') }}" class="card quick-action-card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">Collect Fee</div>
                            <div class="card-title">Record fee payment</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--warning);">
                            <i class="fas fa-money-bill"></i>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('roles.index') }}" class="card quick-action-card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">Manage Roles</div>
                            <div class="card-title">User permissions</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--primary);">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        @if(isset($roleData['recent_students']) && $roleData['recent_students']->count() > 0)
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recently Added Students</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($roleData['recent_students'] as $student)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $student->name }}</h6>
                                        <small class="text-muted">{{ $student->grade }} • {{ $student->section }}</small>
                                    </div>
                                    <span class="badge badge-primary">{{ $student->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Fee Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="fee-summary">
                            <div class="fee-item">
                                <span class="fee-label">Total Collected</span>
                                <span class="fee-amount text-success">${{ number_format($roleData['fee_summary']['total_collected'] ?? 0, 2) }}</span>
                            </div>
                            <div class="fee-item">
                                <span class="fee-label">Pending Collection</span>
                                <span class="fee-amount text-warning">${{ number_format($roleData['fee_summary']['total_pending'] ?? 0, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

@elseif($roleName == 'Student')
    <!-- Student Dashboard -->
    <div class="panel-content active" id="student-panel">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Student Dashboard</h2>
                <span class="badge badge-primary">Welcome, {{ $user->name }}</span>
            </div>
            
            @if(isset($roleData['has_profile']) && $roleData['has_profile'])
            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">{{ $roleData['attendance']->count() }}</div>
                            <div class="card-title">Attendance Records</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--info);">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">{{ $roleData['grades']->count() }}</div>
                            <div class="card-title">Subjects</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--success);">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">{{ $roleData['fees']->where('status', 'pending')->count() }}</div>
                            <div class="card-title">Pending Fees</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--warning);">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> 
                {{ $roleData['message'] ?? 'Student profile not found.' }}
            </div>
            @endif
        </div>
    </div>

@elseif($roleName == 'Staff' || $roleName == 'Teacher')
    <!-- Staff Dashboard -->
    <div class="panel-content active" id="staff-panel">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Staff Dashboard</h2>
                <span class="badge badge-primary">Welcome, {{ $user->name }}</span>
            </div>
            
            @if(isset($roleData['has_profile']) && $roleData['has_profile'])
            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">{{ $roleData['my_students'] ?? 0 }}</div>
                            <div class="card-title">My Students</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--primary);">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">{{ $roleData['today_classes'] ?? 0 }}</div>
                            <div class="card-title">Today's Classes</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--info);">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">{{ $roleData['pending_leaves'] ?? 0 }}</div>
                            <div class="card-title">Pending Leaves</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--warning);">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> 
                {{ $roleData['message'] ?? 'Staff profile not found.' }}
            </div>
            @endif
        </div>
    </div>

@else
    <!-- Default Dashboard for users without roles or with Guest role -->
    <div class="panel-content active" id="default-panel">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Welcome to Student Management System</h2>
            </div>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Welcome, <strong>{{ $user->name }}</strong>! 
                @if($roleName == 'Guest')
                    You currently don't have a specific role assigned.
                @else
                    Your role is <strong>{{ $roleName }}</strong>.
                @endif
            </div>
            
            @if(isset($roleData['message']))
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> 
                {{ $roleData['message'] }}
            </div>
            @endif
            
            <div class="dashboard-cards">
                <a href="{{ route('profile.show') }}" class="card quick-action-card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">My Profile</div>
                            <div class="card-title">View and update profile</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--primary);">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('settings.index') }}" class="card quick-action-card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">Settings</div>
                            <div class="card-title">System preferences</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--info);">
                            <i class="fas fa-cog"></i>
                        </div>
                    </div>
                </a>

                @if(Auth::user()->role && Auth::user()->role->name == 'Admin')
                <a href="{{ route('roles.users', Auth::user()->role->id) }}" class="card quick-action-card">
                    <div class="card-header">
                        <div>
                            <div class="card-stats">Assign Role</div>
                            <div class="card-title">Manage user roles</div>
                        </div>
                        <div class="card-icon" style="background-color: var(--success);">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </div>
@endif

<style>
.card-footer {
    display: block;
    padding: 10px 15px;
    background-color: rgba(0,0,0,0.03);
    border-top: 1px solid rgba(0,0,0,0.125);
    text-decoration: none;
    color: var(--primary);
    font-weight: 500;
    transition: all 0.3s ease;
}

.card-footer:hover {
    background-color: rgba(0,0,0,0.05);
    color: var(--primary-dark);
}

.quick-action-card {
    text-decoration: none;
    color: inherit;
    transition: transform 0.2s ease;
}

.quick-action-card:hover {
    transform: translateY(-2px);
    color: inherit;
}

.fee-summary {
    padding: 10px 0;
}

.fee-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f1f1f1;
}

.fee-item:last-child {
    border-bottom: none;
}

.fee-label {
    font-weight: 500;
    color: #6c757d;
}

.fee-amount {
    font-weight: 600;
    font-size: 1.1rem;
}

.list-group-item {
    border: none;
    border-bottom: 1px solid rgba(0,0,0,0.125);
    padding: 12px 0;
}

.list-group-item:last-child {
    border-bottom: none;
}
</style>
@endsection