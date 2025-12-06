@extends('layouts.app')

@section('title', 'Edit Staff')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Edit Staff Member</h2>
        <a href="{{ route('staff.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Staff
        </a>
    </div>

    <div class="section">
        <form action="{{ route('staff.update', $staff->id) }}" method="POST" id="staff-form">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Staff ID</label>
                        <input type="text" class="form-control" value="{{ $staff->staff_id }}" readonly style="background-color: #f8f9fa;">
                        <small class="form-text text-muted">Staff ID cannot be changed</small>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $staff->first_name) }}" required>
                        @error('first_name')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $staff->last_name) }}" required>
                        @error('last_name')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $staff->email) }}" required>
                        @error('email')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $staff->phone) }}">
                        @error('phone')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Department *</label>
                        <select name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <option value="Teaching" {{ old('department', $staff->department) == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                            <option value="Administration" {{ old('department', $staff->department) == 'Administration' ? 'selected' : '' }}>Administration</option>
                            <option value="Support" {{ old('department', $staff->department) == 'Support' ? 'selected' : '' }}>Support</option>
                            <option value="Management" {{ old('department', $staff->department) == 'Management' ? 'selected' : '' }}>Management</option>
                            <option value="IT" {{ old('department', $staff->department) == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="Finance" {{ old('department', $staff->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Human Resources" {{ old('department', $staff->department) == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                        </select>
                        @error('department')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Position *</label>
                        <input type="text" name="position" class="form-control" value="{{ old('position', $staff->position) }}" required>
                        @error('position')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Qualification</label>
                        <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $staff->qualification) }}">
                        @error('qualification')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Salary ($)</label>
                        <input type="number" name="salary" class="form-control" value="{{ old('salary', $staff->salary) }}" step="0.01" min="0">
                        @error('salary')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Date of Joining *</label>
                        <input type="date" name="date_of_joining" class="form-control" value="{{ old('date_of_joining', $staff->date_of_joining ? $staff->date_of_joining->format('Y-m-d') : '') }}" required>
                        @error('date_of_joining')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="active" {{ old('status', $staff->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $staff->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update Staff Member
                </button>
                <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection