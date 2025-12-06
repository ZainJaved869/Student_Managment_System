@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Student Details</h2>
        <div>
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Student
            </a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Students
            </a>
        </div>
    </div>

    <div class="section">
        <div class="student-profile-header" style="display: flex; align-items: center; margin-bottom: 30px; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; color: white;">
            <div class="user-avatar" style="width: 80px; height: 80px; font-size: 2rem; margin-right: 20px;">
                {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
            </div>
            <div>
                <h3 style="margin: 0; font-size: 1.8rem;">{{ $student->first_name }} {{ $student->last_name }}</h3>
                <p style="margin: 5px 0; opacity: 0.9;">{{ $student->student_id }} • {{ $student->class }} - Section {{ $student->section }}</p>
                <span class="badge {{ $student->status == 'active' ? 'badge-success' : 'badge-warning' }}" style="background: rgba(255,255,255,0.2);">
                    {{ ucfirst($student->status) }}
                </span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Student ID</label>
                    <input type="text" class="form-control" value="{{ $student->student_id }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="text" class="form-control" value="{{ $student->email }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" value="{{ $student->phone ?? 'N/A' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Date of Birth</label>
                    <input type="text" class="form-control" value="{{ $student->date_of_birth ? $student->date_of_birth->format('F d, Y') : 'N/A' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Class & Section</label>
                    <input type="text" class="form-control" value="{{ $student->class }} - Section {{ $student->section }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="{{ ucfirst($student->status) }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Parent/Guardian Name</label>
                    <input type="text" class="form-control" value="{{ $student->parent_name }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Parent Phone</label>
                    <input type="text" class="form-control" value="{{ $student->parent_phone ?? 'N/A' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Address</label>
            <textarea class="form-control" rows="3" readonly style="background-color: #f8f9fa;">{{ $student->address ?? 'N/A' }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Created At</label>
                    <input type="text" class="form-control" value="{{ $student->created_at->format('F d, Y h:i A') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Last Updated</label>
                    <input type="text" class="form-control" value="{{ $student->updated_at->format('F d, Y h:i A') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection