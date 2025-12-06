@extends('layouts.app')

@section('title', 'Fee Details')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Fee Details</h2>
        <div>
            <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Fee
            </a>
            <a href="{{ route('fees.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Fees
            </a>
        </div>
    </div>

    <div class="section">
        <div class="fee-details-header" style="display: flex; align-items: center; margin-bottom: 30px; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; color: white;">
            <div class="user-avatar" style="width: 80px; height: 80px; font-size: 2rem; margin-right: 20px; background-color: var(--warning);">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div>
                <h3 style="margin: 0; font-size: 1.8rem;">Fee Record #FEE-{{ str_pad($fee->id, 4, '0', STR_PAD_LEFT) }}</h3>
                <p style="margin: 5px 0; opacity: 0.9;">{{ $fee->student->first_name }} {{ $fee->student->last_name }}</p>
                <span class="badge {{ $fee->status == 'paid' ? 'badge-success' : ($fee->status == 'overdue' ? 'badge-danger' : 'badge-warning') }}" style="background: rgba(255,255,255,0.2);">
                    {{ ucfirst($fee->status) }}
                </span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Student</label>
                    <input type="text" class="form-control" value="{{ $fee->student->first_name }} {{ $fee->student->last_name }} ({{ $fee->student->student_id }})" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Amount</label>
                    <input type="text" class="form-control" value="${{ number_format($fee->amount, 2) }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Due Date</label>
                    <input type="text" class="form-control" value="{{ $fee->due_date->format('F d, Y') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Paid Date</label>
                    <input type="text" class="form-control" value="{{ $fee->paid_date ? $fee->paid_date->format('F d, Y') : 'Not paid' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Payment Method</label>
                    <input type="text" class="form-control" value="{{ $fee->payment_method ?? 'N/A' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Transaction ID</label>
                    <input type="text" class="form-control" value="{{ $fee->transaction_id ?? 'N/A' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="{{ ucfirst($fee->status) }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Days Remaining/Overdue</label>
                    @php
                        $days = $fee->due_date->diffInDays(now(), false);
                    @endphp
                    <input type="text" class="form-control" value="{{ $days > 0 ? $days . ' days overdue' : abs($days) . ' days remaining' }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Created At</label>
                    <input type="text" class="form-control" value="{{ $fee->created_at->format('F d, Y h:i A') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label class="form-label">Last Updated</label>
                    <input type="text" class="form-control" value="{{ $fee->updated_at->format('F d, Y h:i A') }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection