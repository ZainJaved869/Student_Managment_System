@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Admin Panel -->
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
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Quick Actions</h2>
        </div>
        <div class="dashboard-cards">
            <a href="{{ route('staff.create') }}" class="card" style="text-decoration: none; color: inherit;">
                <div class="card-header">
                    <div>
                        <div class="card-stats" style="font-size: 1.2rem;">Add Staff</div>
                        <div class="card-title">Create new staff member</div>
                    </div>
                    <div class="card-icon" style="background-color: var(--success);">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </a>
            <a href="{{ route('staff.index') }}" class="card" style="text-decoration: none; color: inherit;">
                <div class="card-header">
                    <div>
                        <div class="card-stats" style="font-size: 1.2rem;">View Staff</div>
                        <div class="card-title">Manage staff members</div>
                    </div>
                    <div class="card-icon" style="background-color: var(--primary);">
                        <i class="fas fa-list"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Student Panel -->
<div class="panel-content" id="student-panel">
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Student Dashboard</h2>
        </div>
        <div class="alert alert-warning">
            <i class="fas fa-info-circle"></i> Student panel is not implemented yet.
        </div>
    </div>
</div>

<!-- Staff Panel -->
<div class="panel-content" id="staff-panel">
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Staff Dashboard</h2>
        </div>
        <div class="alert alert-warning">
            <i class="fas fa-info-circle"></i> Staff panel is not implemented yet.
        </div>
    </div>
</div>

<!-- Parent Panel -->
<div class="panel-content" id="parent-panel">
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Parent Dashboard</h2>
        </div>
        <div class="alert alert-warning">
            <i class="fas fa-info-circle"></i> Parent panel is not implemented yet.
        </div>
    </div>
</div>
@endsection