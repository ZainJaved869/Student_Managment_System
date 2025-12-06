@extends('layouts.app')

@section('title', 'Leave Management')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Leave Applications</h2>
        <div>
            <a href="{{ route('leaves.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Apply for Leave
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="dashboard-cards" style="margin-bottom: 30px;">
        <div class="card">
            <div class="card-header">
                <div>
                    @php
                        $pendingCount = $leaves->where('status', 'pending')->count();
                    @endphp
                    <div class="card-stats">{{ $pendingCount }}</div>
                    <div class="card-title">Pending Leaves</div>
                </div>
                <div class="card-icon" style="background-color: var(--warning);">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    @php
                        $approvedCount = $leaves->where('status', 'approved')->count();
                    @endphp
                    <div class="card-stats">{{ $approvedCount }}</div>
                    <div class="card-title">Approved Leaves</div>
                </div>
                <div class="card-icon" style="background-color: var(--success);">
                    <i class="fas fa-check"></i>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    @php
                        $rejectedCount = $leaves->where('status', 'rejected')->count();
                    @endphp
                    <div class="card-stats">{{ $rejectedCount }}</div>
                    <div class="card-title">Rejected Leaves</div>
                </div>
                <div class="card-icon" style="background-color: var(--danger);">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="section" style="margin-bottom: 20px;">
        <form action="{{ route('leaves.index') }}" method="GET">
            <div class="form-row">
                <div class="form-col">
                    <input type="text" name="search" class="form-control" placeholder="Search by applicant name..." value="{{ request('search') }}">
                </div>
                <div class="form-col">
                    <select name="applicant_type" class="form-control">
                        <option value="">All Types</option>
                        <option value="student" {{ request('applicant_type') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="staff" {{ request('applicant_type') == 'staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                </div>
                <div class="form-col">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="form-col">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('leaves.index') }}" class="btn btn-secondary">
                        <i class="fas fa-refresh"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select-all">
                    </th>
                    <th>Applicant</th>
                    <th>Type</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Total Days</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaves as $leave)
                <tr>
                    <td>
                        <input type="checkbox" name="leave_ids[]" value="{{ $leave->id }}" class="leave-checkbox">
                    </td>
                    <td>
                        @if($leave->applicant)
                            <div class="d-flex align-items-center">
                                <div class="user-avatar" style="width: 35px; height: 35px; font-size: 0.8rem; margin-right: 10px; background-color: {{ $leave->applicant_type === 'App\\Models\\Student' ? 'var(--primary)' : 'var(--success)' }};">
                                    {{ substr($leave->applicant->first_name, 0, 1) }}{{ substr($leave->applicant->last_name, 0, 1) }}
                                </div>
                                <div>
                                    {{ $leave->applicant->first_name }} {{ $leave->applicant->last_name }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $leave->applicant_type === 'App\\Models\\Student' ? 'Student' : 'Staff' }}
                                    </small>
                                </div>
                            </div>
                        @else
                            <div class="text-muted">
                                <i class="fas fa-user-slash"></i> Applicant Not Found
                                <br>
                                <small>ID: {{ $leave->applicant_id }}</small>
                            </div>
                        @endif
                    </td>
                    <td>{{ $leave->applicant_type === 'App\\Models\\Student' ? 'Student' : 'Staff' }}</td>
                    <td>{{ $leave->leave_type }}</td>
                    <td>{{ $leave->start_date->format('M d, Y') }}</td>
                    <td>{{ $leave->end_date->format('M d, Y') }}</td>
                    <td>{{ $leave->start_date->diffInDays($leave->end_date) + 1 }} days</td>
                    <td>
                        <span title="{{ $leave->reason }}">
                            {{ Str::limit($leave->reason, 30) }}
                        </span>
                    </td>
                    <td>
                        @if($leave->status === 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($leave->status === 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('leaves.show', $leave->id) }}" class="btn btn-sm" title="View">
                                <i class="fas fa-eye text-info"></i>
                            </a>
                            <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-sm" title="Edit">
                                <i class="fas fa-edit text-primary"></i>
                            </a>
                            @if($leave->status === 'pending')
                            <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm" title="Approve">
                                    <i class="fas fa-check text-success"></i>
                                </button>
                            </form>
                            <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm" title="Reject">
                                    <i class="fas fa-times text-danger"></i>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this leave application?')">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4">
                        <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                        <p>No leave applications found.</p>
                        <a href="{{ route('leaves.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Apply for First Leave
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bulk Actions -->
    <div class="mt-3" id="bulk-actions" style="display: none;">
        <form action="{{ route('leaves.bulk.delete') }}" method="POST" id="bulk-delete-form">
            @csrf
            <input type="hidden" name="leave_ids" id="bulk-leave-ids">
            <button type="button" class="btn btn-danger" onclick="confirmBulkDelete()">
                <i class="fas fa-trash"></i> Delete Selected
            </button>
        </form>
    </div>

    @if($leaves->hasPages())
    <div class="mt-3">
        {{ $leaves->links() }}
    </div>
    @endif
</div>

<style>
.action-buttons {
    display: flex;
    gap: 5px;
}

.action-buttons .btn {
    padding: 5px 8px;
    border: none;
    background: none;
    cursor: pointer;
}

.leave-checkbox {
    cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all functionality
    const selectAll = document.getElementById('select-all');
    const leaveCheckboxes = document.querySelectorAll('.leave-checkbox');
    const bulkActions = document.getElementById('bulk-actions');

    selectAll.addEventListener('change', function() {
        leaveCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        toggleBulkActions();
    });

    leaveCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleBulkActions);
    });

    function toggleBulkActions() {
        const checkedBoxes = document.querySelectorAll('.leave-checkbox:checked');
        if (checkedBoxes.length > 0) {
            bulkActions.style.display = 'block';
        } else {
            bulkActions.style.display = 'none';
        }
    }

    window.confirmBulkDelete = function() {
        const checkedBoxes = document.querySelectorAll('.leave-checkbox:checked');
        const leaveIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        document.getElementById('bulk-leave-ids').value = JSON.stringify(leaveIds);
        
        if (confirm(`Are you sure you want to delete ${leaveIds.length} selected leave application(s)?`)) {
            document.getElementById('bulk-delete-form').submit();
        }
    }
});
</script>
@endsection