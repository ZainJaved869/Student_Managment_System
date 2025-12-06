@extends('layouts.app')

@section('title', 'Fees Management')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Fees Records</h2>
        <div>
            <a href="{{ route('fees.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Collect Fees
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="dashboard-cards" style="margin-bottom: 30px;">
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-stats">${{ number_format($fees->where('status', 'paid')->sum('amount'), 2) }}</div>
                    <div class="card-title">Total Collected</div>
                </div>
                <div class="card-icon" style="background-color: var(--success);">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-stats">${{ number_format($fees->where('status', 'pending')->sum('amount'), 2) }}</div>
                    <div class="card-title">Pending Fees</div>
                </div>
                <div class="card-icon" style="background-color: var(--warning);">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-stats">{{ $fees->where('status', 'overdue')->count() }}</div>
                    <div class="card-title">Overdue Fees</div>
                </div>
                <div class="card-icon" style="background-color: var(--danger);">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="section" style="margin-bottom: 20px;">
        <form action="{{ route('fees.index') }}" method="GET">
            <div class="form-row">
                <div class="form-col">
                    <input type="text" name="search" class="form-control" placeholder="Search by student name..." value="{{ request('search') }}">
                </div>
                <div class="form-col">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                </div>
                <div class="form-col">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('fees.index') }}" class="btn btn-secondary">
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
                    <th>ID</th>
                    <th>Student</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Paid Date</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                <tr>
                    <td>
                        <input type="checkbox" name="fee_ids[]" value="{{ $fee->id }}" class="fee-checkbox">
                    </td>
                    <td>FEE-{{ str_pad($fee->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar" style="width: 35px; height: 35px; font-size: 0.8rem; margin-right: 10px;">
                                {{ substr($fee->student->first_name, 0, 1) }}{{ substr($fee->student->last_name, 0, 1) }}
                            </div>
                            {{ $fee->student->first_name }} {{ $fee->student->last_name }}
                            <br>
                            <small class="text-muted">{{ $fee->student->student_id }}</small>
                        </div>
                    </td>
                    <td>${{ number_format($fee->amount, 2) }}</td>
                    <td>{{ $fee->due_date->format('M d, Y') }}</td>
                    <td>
                        @if($fee->paid_date)
                            {{ $fee->paid_date->format('M d, Y') }}
                        @else
                            <span class="text-muted">Not paid</span>
                        @endif
                    </td>
                    <td>{{ $fee->payment_method ?? 'N/A' }}</td>
                    <td>
                        @if($fee->status === 'paid')
                            <span class="badge badge-success">Paid</span>
                        @elseif($fee->status === 'overdue')
                            <span class="badge badge-danger">Overdue</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('fees.show', $fee->id) }}" class="btn btn-sm" title="View">
                                <i class="fas fa-eye text-info"></i>
                            </a>
                            <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-sm" title="Edit">
                                <i class="fas fa-edit text-primary"></i>
                            </a>
                            @if($fee->status === 'pending')
                            <form action="{{ route('fees.markAsPaid', $fee->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm" title="Mark as Paid">
                                    <i class="fas fa-check text-success"></i>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this fee record?')">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <i class="fas fa-money-bill-wave fa-3x text-muted mb-3"></i>
                        <p>No fee records found.</p>
                        <a href="{{ route('fees.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Fee Record
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bulk Actions -->
    <div class="mt-3" id="bulk-actions" style="display: none;">
        <form action="{{ route('fees.bulk.delete') }}" method="POST" id="bulk-delete-form">
            @csrf
            <input type="hidden" name="fee_ids" id="bulk-fee-ids">
            <button type="button" class="btn btn-danger" onclick="confirmBulkDelete()">
                <i class="fas fa-trash"></i> Delete Selected
            </button>
        </form>
    </div>

    @if($fees->hasPages())
    <div class="mt-3">
        {{ $fees->links() }}
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

.fee-checkbox {
    cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all functionality
    const selectAll = document.getElementById('select-all');
    const feeCheckboxes = document.querySelectorAll('.fee-checkbox');
    const bulkActions = document.getElementById('bulk-actions');

    selectAll.addEventListener('change', function() {
        feeCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        toggleBulkActions();
    });

    feeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleBulkActions);
    });

    function toggleBulkActions() {
        const checkedBoxes = document.querySelectorAll('.fee-checkbox:checked');
        if (checkedBoxes.length > 0) {
            bulkActions.style.display = 'block';
        } else {
            bulkActions.style.display = 'none';
        }
    }

    window.confirmBulkDelete = function() {
        const checkedBoxes = document.querySelectorAll('.fee-checkbox:checked');
        const feeIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        document.getElementById('bulk-fee-ids').value = JSON.stringify(feeIds);
        
        if (confirm(`Are you sure you want to delete ${feeIds.length} selected fee record(s)?`)) {
            document.getElementById('bulk-delete-form').submit();
        }
    }
});
</script>
@endsection