@extends('layouts.app')

@section('title', 'Staff Management')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Staff List</h2>
        <div>
            <a href="{{ route('staff.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Staff
            </a>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="section" style="margin-bottom: 20px;">
        <form action="{{ route('staff.index') }}" method="GET">
            <div class="form-row">
                <div class="form-col">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
                <div class="form-col">
                    <select name="department" class="form-control">
                        <option value="">All Departments</option>
                        <option value="Teaching" {{ request('department') == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                        <option value="Administration" {{ request('department') == 'Administration' ? 'selected' : '' }}>Administration</option>
                        <option value="Support" {{ request('department') == 'Support' ? 'selected' : '' }}>Support</option>
                        <option value="Management" {{ request('department') == 'Management' ? 'selected' : '' }}>Management</option>
                    </select>
                </div>
                <div class="form-col">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="form-col">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('staff.index') }}" class="btn btn-secondary">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($staff as $member)
                <tr>
                    <td>
                        <input type="checkbox" name="staff_ids[]" value="{{ $member->id }}" class="staff-checkbox">
                    </td>
                    <td>{{ $member->staff_id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar" style="width: 35px; height: 35px; font-size: 0.8rem; margin-right: 10px; background-color: var(--success);">
                                {{ substr($member->first_name, 0, 1) }}{{ substr($member->last_name, 0, 1) }}
                            </div>
                            {{ $member->first_name }} {{ $member->last_name }}
                        </div>
                    </td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone ?? 'N/A' }}</td>
                    <td>
                        <span class="badge badge-primary">{{ $member->department }}</span>
                    </td>
                    <td>{{ $member->position }}</td>
                    <td>
                        @if($member->salary)
                            ${{ number_format($member->salary, 2) }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $member->status == 'active' ? 'success' : 'warning' }}">
                            {{ ucfirst($member->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('staff.show', $member->id) }}" class="btn btn-sm" title="View">
                                <i class="fas fa-eye text-info"></i>
                            </a>
                            <a href="{{ route('staff.edit', $member->id) }}" class="btn btn-sm" title="Edit">
                                <i class="fas fa-edit text-primary"></i>
                            </a>
                            <form action="{{ route('staff.destroy', $member->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete {{ $member->first_name }} {{ $member->last_name }}?')">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4">
                        <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                        <p>No staff members found.</p>
                        <a href="{{ route('staff.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Staff Member
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bulk Actions -->
    <div class="mt-3" id="bulk-actions" style="display: none;">
        <form action="{{ route('staff.bulk.delete') }}" method="POST" id="bulk-delete-form">
            @csrf
            <input type="hidden" name="staff_ids" id="bulk-staff-ids">
            <button type="button" class="btn btn-danger" onclick="confirmBulkDelete()">
                <i class="fas fa-trash"></i> Delete Selected
            </button>
        </form>
    </div>

    @if($staff->hasPages())
    <div class="mt-3">
        {{ $staff->links() }}
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

.staff-checkbox {
    cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all functionality
    const selectAll = document.getElementById('select-all');
    const staffCheckboxes = document.querySelectorAll('.staff-checkbox');
    const bulkActions = document.getElementById('bulk-actions');

    selectAll.addEventListener('change', function() {
        staffCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        toggleBulkActions();
    });

    staffCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleBulkActions);
    });

    function toggleBulkActions() {
        const checkedBoxes = document.querySelectorAll('.staff-checkbox:checked');
        if (checkedBoxes.length > 0) {
            bulkActions.style.display = 'block';
        } else {
            bulkActions.style.display = 'none';
        }
    }

    window.confirmBulkDelete = function() {
        const checkedBoxes = document.querySelectorAll('.staff-checkbox:checked');
        const staffIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        document.getElementById('bulk-staff-ids').value = JSON.stringify(staffIds);
        
        if (confirm(`Are you sure you want to delete ${staffIds.length} selected staff member(s)?`)) {
            document.getElementById('bulk-delete-form').submit();
        }
    }
});
</script>
@endsection