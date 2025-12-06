@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">

    <!-- Header / Welcome -->
    <div class="dashboard-header">
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p>Role: {{ auth()->user()->role ?? 'Administrator' }}</p>
    </div>

    <!-- Overview Cards -->
    <div class="overview-cards">
        <div class="card">
            <i class="fas fa-user-graduate"></i>
            <div class="value">{{ $totalStudents ?? 0 }}</div>
            <div class="label">Students</div>
        </div>
        <div class="card">
            <i class="fas fa-chalkboard-teacher"></i>
            <div class="value">{{ $totalTeachers ?? 0 }}</div>
            <div class="label">Teachers</div>
        </div>
        <div class="card">
            <i class="fas fa-users"></i>
            <div class="value">{{ $totalStaff ?? 0 }}</div>
            <div class="label">Staff</div>
        </div>
        <div class="card">
            <i class="fas fa-coins"></i>
            <div class="value">${{ $pendingFees ?? 0 }}</div>
            <div class="label">Pending Fees</div>
        </div>
    </div>

  

    <!-- Upcoming Events -->
    <div class="upcoming-events">
        <h3>Upcoming Events</h3>
        <ul>
            @foreach($events ?? [] as $event)
                <li>{{ $event->title }} - {{ $event->date->format('d M Y') }}</li>
            @endforeach
            @if(empty($events ?? []))
                <li>No upcoming events.</li>
            @endif
        </ul>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h3>Recent Activity</h3>
        <ul>
            @foreach($recentLogs ?? [] as $log)
                <li>{{ $log->message }} - {{ $log->created_at->diffForHumans() }}</li>
            @endforeach
            @if(empty($recentLogs ?? []))
                <li>No recent activity.</li>
            @endif
        </ul>
    </div>

    <!-- Charts -->
    <div class="charts">
        <div>
            <h3>Enrollment Trend</h3>
            <canvas id="enrollmentChart"></canvas>
        </div>
        <div>
            <h3>Fee Collection</h3>
            <canvas id="feeChart"></canvas>
        </div>
    </div>

</div>

<style>
.dashboard-container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
.dashboard-header h1 { font-size: 2rem; margin-bottom: 0.25rem; }
.dashboard-header p { color: #555; margin-bottom: 2rem; }
.overview-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
.card { background: white; padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.card i { font-size: 2rem; margin-bottom: 0.5rem; color: #667eea; }
.card .value { font-size: 1.75rem; font-weight: bold; }
.card .label { color: #777; }
.quick-actions { margin-bottom: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; }
.btn { display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 6px; border: none; cursor: pointer; transition: 0.2s; }
.btn-primary { background: #667eea; color: white; }
.btn-info { background: #0ea5e9; color: white; }
.btn-success { background: #10b981; color: white; }
.btn:hover { opacity: 0.9; }
.upcoming-events, .recent-activity { margin-bottom: 2rem; background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.upcoming-events ul, .recent-activity ul { margin: 0; padding: 0; list-style: none; }
.upcoming-events li, .recent-activity li { padding: 0.5rem 0; border-bottom: 1px solid #eee; }
.charts { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enrollment Chart
    const ctxEnroll = document.getElementById('enrollmentChart').getContext('2d');
    new Chart(ctxEnroll, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Enrollments',
                data: [50, 60, 70, 80, 90, 100],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.2)',
                tension: 0.4
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // Fee Collection Chart
    const ctxFee = document.getElementById('feeChart').getContext('2d');
    new Chart(ctxFee, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Fees Collected',
                data: [5000, 6000, 5500, 7000, 6500, 8000],
                backgroundColor: '#10b981'
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
});
</script>
@endsection
