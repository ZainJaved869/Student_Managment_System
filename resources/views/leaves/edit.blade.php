@extends('layouts.app')

@section('title', 'Edit Leave Application')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Edit Leave Application</h2>
        <a href="{{ route('leaves.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Leaves
        </a>
    </div>

    <div class="section">
        <form action="{{ route('leaves.update', $leave->id) }}" method="POST" id="leave-form">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Applicant Type *</label>
                        <select name="applicant_type" class="form-control" id="applicant-type" required>
                            <option value="">Select Applicant Type</option>
                            <option value="student" {{ old('applicant_type', $leave->applicant_type === 'App\\Models\\Student' ? 'student' : 'staff') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="staff" {{ old('applicant_type', $leave->applicant_type === 'App\\Models\\Student' ? 'student' : 'staff') == 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('applicant_type')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Applicant *</label>
                        <select name="applicant_id" class="form-control" id="applicant-select" required>
                            <option value="">Select Applicant</option>
                        </select>
                        @error('applicant_id')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Leave Type *</label>
                        <select name="leave_type" class="form-control" required>
                            <option value="">Select Leave Type</option>
                            <option value="Sick Leave" {{ old('leave_type', $leave->leave_type) == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                            <option value="Personal Leave" {{ old('leave_type', $leave->leave_type) == 'Personal Leave' ? 'selected' : '' }}>Personal Leave</option>
                            <option value="Vacation" {{ old('leave_type', $leave->leave_type) == 'Vacation' ? 'selected' : '' }}>Vacation</option>
                            <option value="Emergency Leave" {{ old('leave_type', $leave->leave_type) == 'Emergency Leave' ? 'selected' : '' }}>Emergency Leave</option>
                            <option value="Maternity Leave" {{ old('leave_type', $leave->leave_type) == 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
                            <option value="Paternity Leave" {{ old('leave_type', $leave->leave_type) == 'Paternity Leave' ? 'selected' : '' }}>Paternity Leave</option>
                            <option value="Study Leave" {{ old('leave_type', $leave->leave_type) == 'Study Leave' ? 'selected' : '' }}>Study Leave</option>
                            <option value="Other" {{ old('leave_type', $leave->leave_type) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('leave_type')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Start Date *</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $leave->start_date ? $leave->start_date->format('Y-m-d') : '') }}" required>
                        @error('start_date')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">End Date *</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $leave->end_date ? $leave->end_date->format('Y-m-d') : '') }}" required>
                        @error('end_date')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ old('status', $leave->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status', $leave->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status', $leave->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Reason *</label>
                <textarea name="reason" class="form-control" rows="4" required>{{ old('reason', $leave->reason) }}</textarea>
                @error('reason')
                    <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update Leave Application
                </button>
                <a href="{{ route('leaves.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const applicantType = document.getElementById('applicant-type');
    const applicantSelect = document.getElementById('applicant-select');
    const currentApplicantId = {{ $leave->applicant_id }};

    // Initialize applicant select based on current type
    function initializeApplicantSelect() {
        const type = applicantType.value;
        applicantSelect.innerHTML = '<option value="">Select Applicant</option>';

        if (type === 'student') {
            @foreach($students as $student)
                applicantSelect.innerHTML += `<option value="{{ $student->id }}" {{ $student->id == $leave->applicant_id && $leave->applicant_type === 'App\\Models\\Student' ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_id }})</option>`;
            @endforeach
        } else if (type === 'staff') {
            @foreach($staff as $member)
                applicantSelect.innerHTML += `<option value="{{ $member->id }}" {{ $member->id == $leave->applicant_id && $leave->applicant_type === 'App\\Models\\Staff' ? 'selected' : '' }}>{{ $member->first_name }} {{ $member->last_name }} ({{ $member->staff_id }})</option>`;
            @endforeach
        }
    }

    // Trigger change on page load
    initializeApplicantSelect();

    // Applicant type change handler
    applicantType.addEventListener('change', initializeApplicantSelect);
});
</script>
@endsection