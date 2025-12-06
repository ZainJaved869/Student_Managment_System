@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Edit Student</h2>
        <a href="{{ route('students.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Students
        </a>
    </div>

    <div class="section">
        <form action="{{ route('students.update', $student->id) }}" method="POST" id="student-form">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Student ID</label>
                        <input type="text" class="form-control" value="{{ $student->student_id }}" readonly style="background-color: #f8f9fa;">
                        <small class="form-text text-muted">Student ID cannot be changed</small>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
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
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
                        @error('last_name')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
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
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}">
                        @error('phone')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Class *</label>
                        <select name="class" class="form-control" required>
                            <option value="">Select Class</option>
                            <option value="9th Grade" {{ old('class', $student->class) == '9th Grade' ? 'selected' : '' }}>9th Grade</option>
                            <option value="10th Grade" {{ old('class', $student->class) == '10th Grade' ? 'selected' : '' }}>10th Grade</option>
                            <option value="11th Grade" {{ old('class', $student->class) == '11th Grade' ? 'selected' : '' }}>11th Grade</option>
                            <option value="12th Grade" {{ old('class', $student->class) == '12th Grade' ? 'selected' : '' }}>12th Grade</option>
                        </select>
                        @error('class')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Section *</label>
                        <select name="section" class="form-control" required>
                            <option value="">Select Section</option>
                            <option value="A" {{ old('section', $student->section) == 'A' ? 'selected' : '' }}>Section A</option>
                            <option value="B" {{ old('section', $student->section) == 'B' ? 'selected' : '' }}>Section B</option>
                            <option value="C" {{ old('section', $student->section) == 'C' ? 'selected' : '' }}>Section C</option>
                            <option value="D" {{ old('section', $student->section) == 'D' ? 'selected' : '' }}>Section D</option>
                        </select>
                        @error('section')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Parent/Guardian Name *</label>
                        <input type="text" name="parent_name" class="form-control" value="{{ old('parent_name', $student->parent_name) }}" required>
                        @error('parent_name')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Parent Phone</label>
                        <input type="text" name="parent_phone" class="form-control" value="{{ old('parent_phone', $student->parent_phone) }}">
                        @error('parent_phone')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : '') }}">
                        @error('date_of_birth')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address', $student->address) }}</textarea>
                @error('address')
                    <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update Student
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection