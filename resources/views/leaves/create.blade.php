@extends('layouts.app')

@section('title', 'Apply for Leave')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Apply for Leave</h2>
        <a href="{{ route('leaves.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Leaves
        </a>
    </div>

    <div class="section">
        <form action="{{ route('leaves.store') }}" method="POST" id="leave-form">
            @csrf
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Applicant Type *</label>
                        <select name="applicant_type" class="form-control" id="applicant-type" required>
                            <option value="">Select Applicant Type</option>
                            <option value="student" {{ old('applicant_type') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="staff" {{ old('applicant_type') == 'staff' ? 'selected' : '' }}>Staff</option>
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
                            <option value="Sick Leave" {{ old('leave_type') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                            <option value="Personal Leave" {{ old('leave_type') == 'Personal Leave' ? 'selected' : '' }}>Personal Leave</option>
                            <option value="Vacation" {{ old('leave_type') == 'Vacation' ? 'selected' : '' }}>Vacation</option>
                            <option value="Emergency Leave" {{ old('leave_type') == 'Emergency Leave' ? 'selected' : '' }}>Emergency Leave</option>
                            <option value="Maternity Leave" {{ old('leave_type') == 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
                            <option value="Paternity Leave" {{ old('leave_type') == 'Paternity Leave' ? 'selected' : '' }}>Paternity Leave</option>
                            <option value="Study Leave" {{ old('leave_type') == 'Study Leave' ? 'selected' : '' }}>Study Leave</option>
                            <option value="Other" {{ old('leave_type') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('leave_type')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Start Date *</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
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
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Total Days</label>
                        <input type="text" class="form-control" id="total-days" readonly style="background-color: #f8f9fa;">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Reason *</label>
                <textarea name="reason" class="form-control" rows="4" placeholder="Please provide a detailed reason for your leave..." required>{{ old('reason') }}</textarea>
                @error('reason')
                    <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-paper-plane"></i> Submit Leave Application
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
    const startDate = document.querySelector('input[name="start_date"]');
    const endDate = document.querySelector('input[name="end_date"]');
    const totalDays = document.getElementById('total-days');

    // Applicant type change handler
    applicantType.addEventListener('change', function() {
        const type = this.value;
        applicantSelect.innerHTML = '<option value="">Select Applicant</option>';

        if (type === 'student') {
            @foreach($students as $student)
                applicantSelect.innerHTML += `<option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_id }})</option>`;
            @endforeach
        } else if (type === 'staff') {
            @foreach($staff as $member)
                applicantSelect.innerHTML += `<option value="{{ $member->id }}">{{ $member->first_name }} {{ $member->last_name }} ({{ $member->staff_id }})</option>`;
            @endforeach
        }
    });

    // Calculate total days
    function calculateTotalDays() {
        if (startDate.value && endDate.value) {
            const start = new Date(startDate.value);
            const end = new Date(endDate.value);
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            totalDays.value = diffDays + ' days';
        } else {
            totalDays.value = '';
        }
    }

    startDate.addEventListener('change', calculateTotalDays);
    endDate.addEventListener('change', calculateTotalDays);

    // Form validation
    const form = document.getElementById('leave-form');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let valid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                valid = false;
                field.style.borderColor = 'red';
            } else {
                field.style.borderColor = '';
            }
        });
        
        if (!valid) {
            e.preventDefault();
            alert('Please fill all required fields.');
        }
    });

    // Set default dates
    const today = new Date().toISOString().split('T')[0];
    startDate.min = today;
    endDate.min = today;
});
</script>
@endsection