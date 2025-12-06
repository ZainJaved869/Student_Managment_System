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

    <!-- Recent Students -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Recent Students</h2>
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Student
            </a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Parent</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentStudents as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->section }}</td>
                        <td>{{ $student->parent_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <span class="badge badge-{{ $student->status == 'active' ? 'success' : 'warning' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn" style="padding: 5px;">
                                <i class="fas fa-edit text-primary"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="padding: 5px;" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No students found. <a href="{{ route('students.create') }}">Add the first student</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pending Leave Requests -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Pending Leave Requests</h2>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Applicant</th>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingLeaves as $leave)
                    <tr>
                        <td>
                            @if($leave->applicant_type === 'App\\Models\\Staff')
                                {{ $leave->applicant->first_name }} {{ $leave->applicant->last_name }} (Staff)
                            @else
                                {{ $leave->applicant->first_name }} {{ $leave->applicant->last_name }} (Student)
                            @endif
                        </td>
                        <td>{{ $leave->leave_type }}</td>
                        <td>{{ $leave->start_date->format('d M, Y') }}</td>
                        <td>{{ $leave->end_date->format('d M, Y') }}</td>
                        <td>{{ $leave->reason }}</td>
                        <td><span class="status status-pending">Pending</span></td>
                        <td>
                            <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success" style="padding: 5px 10px; font-size: 0.8rem;">Approve</button>
                            </form>
                            <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.8rem;">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No pending leave requests</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Student Panel -->
<div class="panel-content" id="student-panel">
    <!-- Student panel content would go here -->
</div>

<!-- Staff Panel -->
<div class="panel-content" id="staff-panel">
    <!-- Staff panel content would go here -->
</div>

<!-- Parent Panel -->
<div class="panel-content" id="parent-panel">
    <!-- Parent panel content would go here -->
</div>
@endsection