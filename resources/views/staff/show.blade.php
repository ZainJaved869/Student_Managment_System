@extends('layouts.app')

@section('title', 'Staff Details')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Staff Details</h2>
        <div>
            <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Staff
            </a>
            <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Staff
            </a>
        </div>
    </div>

    <div class="section">
        <div class="staff-profile-header" style="display: flex; align-items: center; margin-bottom: 30px; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; color: white;">
            <div class="user-avatar" style="width: 80px; height: 80px; font-size: 2rem; margin-right: 20px; background-color: var(--success);">
                {{ substr($staff->first_name, 0, 1) }}{{ substr($staff->last_name, 0, 1) }}
            </div>
            <div>
                <h3 style="margin: 0; font-size: 1.8rem;">{{ $staff->first_name }} {{ $staff->last_name }}</h3>
                <p style="margin: 5px 0; opacity: 0.9;">{{ $staff->staff_id }} • {{ $staff->position }}</p>
                <span class="badge {{ $staff->status == 'active' ? 'badge-success' : 'badge-warning' }}" style="background: rgba(255,255,255,0.2);">
                    {{ ucfirst($staff->status) }}
                </span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Staff ID</label>
                    <input type="text" class="form-control" value="{{ $staff->staff_id }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="text" class="form-control" value="{{ $staff->email }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" value="{{ $staff->phone ?? 'N/A' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Department</label>
                    <input type="text" class="form-control" value="{{ $staff->department }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Position</label>
                    <input type="text" class="form-control" value="{{ $staff->position }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Qualification</label>
                    <input type="text" class="form-control" value="{{ $staff->qualification ?? 'N/A' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Salary</label>
                    <input type="text" class="form-control" value="{{ $staff->salary ? '$' . number_format($staff->salary, 2) : 'N/A' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Date of Joining</label>
                    <input type="text" class="form-control" value="{{ $staff->date_of_joining->format('F d, Y') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="{{ ucfirst($staff->status) }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Years of Service</label>
                    <input type="text" class="form-control" value="{{ $staff->date_of_joining->diffInYears(now()) }} years" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Created At</label>
                    <input type="text" class="form-control" value="{{ $staff->created_at->format('F d, Y h:i A') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Last Updated</label>
                    <input type="text" class="form-control" value="{{ $staff->updated_at->format('F d, Y h:i A') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection