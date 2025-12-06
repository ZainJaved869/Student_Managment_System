@extends('layouts.app')

@section('title', 'Edit Fee Record')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Edit Fee Record</h2>
        <a href="{{ route('fees.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Fees
        </a>
    </div>

    <div class="section">
        <form action="{{ route('fees.update', $fee->id) }}" method="POST" id="fee-form">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Student *</label>
                        <select name="student_id" class="form-control" required>
                            <option value="">Select Student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id', $fee->student_id) == $student->id ? 'selected' : '' }}>
                                    {{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_id }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Amount ($) *</label>
                        <input type="number" name="amount" class="form-control" value="{{ old('amount', $fee->amount) }}" step="0.01" min="0" required>
                        @error('amount')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Due Date *</label>
                        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $fee->due_date ? $fee->due_date->format('Y-m-d') : '') }}" required>
                        @error('due_date')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Paid Date</label>
                        <input type="date" name="paid_date" class="form-control" value="{{ old('paid_date', $fee->paid_date ? $fee->paid_date->format('Y-m-d') : '') }}">
                        @error('paid_date')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-control">
                            <option value="">Select Payment Method</option>
                            <option value="Cash" {{ old('payment_method', $fee->payment_method) == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Credit Card" {{ old('payment_method', $fee->payment_method) == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="Debit Card" {{ old('payment_method', $fee->payment_method) == 'Debit Card' ? 'selected' : '' }}>Debit Card</option>
                            <option value="Bank Transfer" {{ old('payment_method', $fee->payment_method) == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="Online Payment" {{ old('payment_method', $fee->payment_method) == 'Online Payment' ? 'selected' : '' }}>Online Payment</option>
                            <option value="Check" {{ old('payment_method', $fee->payment_method) == 'Check' ? 'selected' : '' }}>Check</option>
                        </select>
                        @error('payment_method')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id', $fee->transaction_id) }}">
                        @error('transaction_id')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ old('status', $fee->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('status', $fee->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="overdue" {{ old('status', $fee->status) == 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
                @error('status')
                    <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update Fee Record
                </button>
                <a href="{{ route('fees.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection