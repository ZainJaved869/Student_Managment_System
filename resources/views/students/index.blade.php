@extends('layouts.app')

@section('title', 'Student Management')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Student List</h2>
        <div>
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Student
            </a>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="section" style="margin-bottom: 20px;">
        <form action="{{ route('students.index') }}" method="GET">
            <div class="form-row">
                <div class="form-col">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
                <div class="form-col">
                    <select name="class" class="form-control">
                        <option value="">All Classes</option>
                        <option value="9th Grade" {{ request('class') == '9th Grade' ? 'selected' : '' }}>9th Grade</option>
                        <option value="10th Grade" {{ request('class') == '10th Grade' ? 'selected' : '' }}>10th Grade</option>
                        <option value="11th Grade" {{ request('class') == '11th Grade' ? 'selected' : '' }}>11th Grade</option>
                        <option value="12th Grade" {{ request('class') == '12th Grade' ? 'selected' : '' }}>12th Grade</option>
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
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
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
                    <th>Class</th>
                    <th>Section</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>
                        <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" class="student-checkbox">
                    </td>
                    <td>{{ $student->student_id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar" style="width: 35px; height: 35px; font-size: 0.8rem; margin-right: 10px;">
                                {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                            </div>
                            {{ $student->first_name }} {{ $student->last_name }}
                        </div>
                    </td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone ?? 'N/A' }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->section }}</td>
                    <td>{{ $student->parent_name }}</td>
                    <td>
                        <span class="badge badge-{{ $student->status == 'active' ? 'success' : 'warning' }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm" title="View">
                                <i class="fas fa-eye text-info"></i>
                            </a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm" title="Edit">
                                <i class="fas fa-edit text-primary"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete {{ $student->first_name }} {{ $student->last_name }}?')">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4">
                        <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                        <p>No students found.</p>
                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Student
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bulk Actions -->
    <div class="mt-3" id="bulk-actions" style="display: none;">
        <form action="{{ route('students.bulk.delete') }}" method="POST" id="bulk-delete-form">
            @csrf
            <input type="hidden" name="student_ids" id="bulk-student-ids">
            <button type="button" class="btn btn-danger" onclick="confirmBulkDelete()">
                <i class="fas fa-trash"></i> Delete Selected
            </button>
        </form>
    </div>

    @if($students->hasPages())
    <div class="mt-3">
        {{ $students->links() }}
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

.student-checkbox {
    cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all functionality
    const selectAll = document.getElementById('select-all');
    const studentCheckboxes = document.querySelectorAll('.student-checkbox');
    const bulkActions = document.getElementById('bulk-actions');

    selectAll.addEventListener('change', function() {
        studentCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        toggleBulkActions();
    });

    studentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleBulkActions);
    });

    function toggleBulkActions() {
        const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
        if (checkedBoxes.length > 0) {
            bulkActions.style.display = 'block';
        } else {
            bulkActions.style.display = 'none';
        }
    }

    window.confirmBulkDelete = function() {
        const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
        const studentIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        document.getElementById('bulk-student-ids').value = JSON.stringify(studentIds);
        
        if (confirm(`Are you sure you want to delete ${studentIds.length} selected student(s)?`)) {
            document.getElementById('bulk-delete-form').submit();
        }
    }
});
</script>
@endsection