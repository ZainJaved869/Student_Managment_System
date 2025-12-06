@extends('app')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-cards">

    <!-- Students -->
    <div class="card card-students">
        <div class="card-header">
            <div class="card-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
        <div class="card-stats">{{ number_format($stats['total_students']) }}</div>
        <div class="card-title">Total Students</div>
    </div>

    <!-- Staff -->
    <div class="card card-staff">
        <div class="card-header">
            <div class="card-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>
        <div class="card-stats">{{ number_format($stats['total_staff']) }}</div>
        <div class="card-title">Total Staff</div>
    </div>

    <!-- Fees -->
    <div class="card card-fees">
        <div class="card-header">
            <div class="card-icon">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        <div class="card-stats">${{ number_format($stats['total_fees']) }}</div>
        <div class="card-title">Fees Collected</div>
    </div>

    <!-- Leaves -->
    <div class="card card-leaves">
        <div class="card-header">
            <div class="card-icon">
                <i class="fas fa-calendar-times"></i>
            </div>
        </div>
        <div class="card-stats">{{ number_format($stats['pending_leaves']) }}</div>
        <div class="card-title">Pending Leaves</div>
    </div>

</div>


<!-- Recent Students -->
<div class="section">
    <div class="section-header">
        <h3>Recent Registered Students</h3>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Roll No</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentStudents as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->created_at->format('d M, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No recent student registrations.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<!-- Pending Leaves -->
<div class="section">
    <div class="section-header">
        <h3>Pending Leave Requests</h3>
    </div>

    @forelse($pendingLeaves as $leave)
        <div class="leave-item">
            <div class="leave-avatar">
                {{ strtoupper(substr($leave->applicant->name ?? 'U', 0, 1)) }}
            </div>
            <div class="leave-details">
                <h4>{{ $leave->applicant->name ?? 'Unknown User' }}</h4>
                <p>{{ $leave->leave_type }}</p>
                <span class="leave-date">{{ $leave->from_date }} - {{ $leave->to_date }}</span>
            </div>
            <div class="leave-actions">
                <button class="btn btn-success">Approve</button>
                <button class="btn btn-danger">Reject</button>
            </div>
        </div>
    @empty
        <p class="text-muted">No pending leaves.</p>
    @endforelse
</div>

@endsection
