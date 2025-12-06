@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card p-3">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <h2>{{ $totalStudents }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="card-body">
                    <h5>Total Staff</h5>
                    <h2>{{ $totalStaff }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="card-body">
                    <h5>Pending Fees</h5>
                    <h2>{{ $pendingFees }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="card-body">
                    <h5>Pending Leaves</h5>
                    <h2>{{ $pendingLeaves }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Records -->
    <div class="row">
        <!-- Recent Students -->
        <div class="col-md-6 mb-4">
            <div class="card p-3">
                <div class="card-header">
                    <h5>Recent Students</h5>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($recentStudents as $student)
                            <li>{{ $student->name }} - {{ $student->class ?? 'N/A' }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Staff -->
        <div class="col-md-6 mb-4">
            <div class="card p-3">
                <div class="card-header">
                    <h5>Recent Staff</h5>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($recentStaff as $staff)
                            <li>{{ $staff->name }} - {{ $staff->role ?? 'N/A' }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Fees -->
        <div class="col-md-6 mb-4">
            <div class="card p-3">
                <div class="card-header">
                    <h5>Recent Fees</h5>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($recentFees as $fee)
                            <li>{{ $fee->student->name ?? 'N/A' }} - ${{ $fee->amount }} - {{ ucfirst($fee->status) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Leaves -->
        <div class="col-md-6 mb-4">
            <div class="card p-3">
                <div class="card-header">
                    <h5>Recent Leaves</h5>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($recentLeaves as $leave)
                            <li>{{ $leave->staff->name ?? 'N/A' }} - {{ ucfirst($leave->status) }} - {{ $leave->start_date }} to {{ $leave->end_date }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
