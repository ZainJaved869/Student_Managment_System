@extends('layouts.app')

@section('title', 'Leave Details')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Leave Application Details</h2>
        <div>
            <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Leave
            </a>
            <a href="{{ route('leaves.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Leaves
            </a>
        </div>
    </div>

    <div class="section">
        <div class="leave-details-header" style="display: flex; align-items: center; margin-bottom: 30px; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; color: white;">
            @if($leave->applicant)
                <div class="user-avatar" style="width: 80px; height: 80px; font-size: 2rem; margin-right: 20px; background-color: {{ $leave->applicant_type === 'App\\Models\\Student' ? 'var(--primary)' : 'var(--success)' }};">
                    {{ substr($leave->applicant->first_name, 0, 1) }}{{ substr($leave->applicant->last_name, 0, 1) }}
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 1.8rem;">{{ $leave->applicant->first_name }} {{ $leave->applicant->last_name }}</h3>
                    <p style="margin: 5px 0; opacity: 0.9;">{{ $leave->applicant_type === 'App\\Models\\Student' ? 'Student' : 'Staff' }} • {{ $leave->leave_type }}</p>
                    <span class="badge {{ $leave->status == 'approved' ? 'badge-success' : ($leave->status == 'rejected' ? 'badge-danger' : 'badge-warning') }}" style="background: rgba(255,255,255,0.2);">
                        {{ ucfirst($leave->status) }}
                    </span>
                </div>
            @else
                <div class="user-avatar" style="width: 80px; height: 80px; font-size: 2rem; margin-right: 20px; background-color: var(--danger);">
                    <i class="fas fa-user-slash"></i>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 1.8rem;">Applicant Not Found</h3>
                    <p style="margin: 5px 0; opacity: 0.9;">ID: {{ $leave->applicant_id }} • {{ $leave->leave_type }}</p>
                    <span class="badge badge-danger" style="background: rgba(255,255,255,0.2);">
                        Applicant Missing
                    </span>
                </div>
            @endif
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Applicant</label>
                    @if($leave->applicant)
                        <input type="text" class="form-control" value="{{ $leave->applicant->first_name }} {{ $leave->applicant->last_name }} ({{ $leave->applicant_type === 'App\\Models\\Student' ? $leave->applicant->student_id : $leave->applicant->staff_id }})" readonly style="background-color: #f8f9fa;">
                    @else
                        <input type="text" class="form-control" value="Applicant Not Found (ID: {{ $leave->applicant_id }})" readonly style="background-color: #f8f9fa;">
                    @endif
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Applicant Type</label>
                    <input type="text" class="form-control" value="{{ $leave->applicant_type === 'App\\Models\\Student' ? 'Student' : 'Staff' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Leave Type</label>
                    <input type="text" class="form-control" value="{{ $leave->leave_type }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="{{ ucfirst($leave->status) }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="text" class="form-control" value="{{ $leave->start_date->format('F d, Y') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="text" class="form-control" value="{{ $leave->end_date->format('F d, Y') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Total Days</label>
                    <input type="text" class="form-control" value="{{ $leave->start_date->diffInDays($leave->end_date) + 1 }} days" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Days Remaining/Completed</label>
                    @php
                        $today = now();
                        $daysRemaining = $leave->start_date->diffInDays($today, false);
                        if ($daysRemaining < 0) {
                            $statusText = abs($daysRemaining) . ' days remaining';
                        } elseif ($daysRemaining > $leave->start_date->diffInDays($leave->end_date)) {
                            $statusText = 'Completed';
                        } else {
                            $statusText = 'In progress';
                        }
                    @endphp
                    <input type="text" class="form-control" value="{{ $statusText }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Reason</label>
            <textarea class="form-control" rows="4" readonly style="background-color: #f8f9fa;">{{ $leave->reason }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Created At</label>
                    <input type="text" class="form-control" value="{{ $leave->created_at->format('F d, Y h:i A') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Last Updated</label>
                    <input type="text" class="form-control" value="{{ $leave->updated_at->format('F d, Y h:i A') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection