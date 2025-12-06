@extends('layouts.app')

@section('title', 'Add New Staff')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Add New Staff Member</h2>
        <a href="{{ route('staff.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Staff
        </a>
    </div>

    <div class="section">
        <form action="{{ route('staff.store') }}" method="POST" id="staff-form">
            @csrf
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1 (555) 123-4567">
                        @error('phone')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Department *</label>
                        <select name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <option value="Teaching" {{ old('department') == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                            <option value="Administration" {{ old('department') == 'Administration' ? 'selected' : '' }}>Administration</option>
                            <option value="Support" {{ old('department') == 'Support' ? 'selected' : '' }}>Support</option>
                            <option value="Management" {{ old('department') == 'Management' ? 'selected' : '' }}>Management</option>
                            <option value="IT" {{ old('department') == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Human Resources" {{ old('department') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                        </select>
                        @error('department')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Position *</label>
                        <input type="text" name="position" class="form-control" value="{{ old('position') }}" placeholder="e.g., Teacher, Administrator, etc." required>
                        @error('position')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Qualification</label>
                        <input type="text" name="qualification" class="form-control" value="{{ old('qualification') }}" placeholder="e.g., M.Sc., B.Ed., etc.">
                        @error('qualification')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Salary ($)</label>
                        <input type="number" name="salary" class="form-control" value="{{ old('salary') }}" placeholder="0.00" step="0.01" min="0">
                        @error('salary')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Date of Joining *</label>
                        <input type="date" name="date_of_joining" class="form-control" value="{{ old('date_of_joining') }}" required>
                        @error('date_of_joining')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Staff Member
                </button>
                <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('staff-form');
    
    form.addEventListener('submit', function(e) {
        // Basic validation
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
});
</script>
@endsection