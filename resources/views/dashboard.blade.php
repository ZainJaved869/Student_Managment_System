@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="attractive-dashboard">
    <!-- Welcome Header -->
    <div class="welcome-header">
        <div class="welcome-text">
            <h1>Welcome back, {{ auth()->user()->name }}! 🎉</h1>
            <p>Here's what's happening in your school today</p>
        </div>
        <div class="date-display">
            <div class="current-date" id="current-date"></div>
            <div class="current-time" id="current-time"></div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions-section">
        <h2 class="section-title">Quick Actions ⚡</h2>
        <div class="action-grid">
            <a href="{{ route('students.create') }}" class="action-card student-action">
                <div class="action-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="action-content">
                    <h3>Add New Student</h3>
                    <p>Register a new student</p>
                </div>
                <div class="action-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('fees.create') }}" class="action-card fee-action">
                <div class="action-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="action-content">
                    <h3>Collect Fees</h3>
                    <p>Process fee payment</p>
                </div>
                <div class="action-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('leaves.create') }}" class="action-card leave-action">
                <div class="action-icon">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div class="action-content">
                    <h3>Apply Leave</h3>
                    <p>Submit leave application</p>
                </div>
                <div class="action-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('staff.create') }}" class="action-card staff-action">
                <div class="action-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="action-content">
                    <h3>Add Staff</h3>
                    <p>Register new staff member</p>
                </div>
                <div class="action-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>

    <!-- You can continue with your stats, charts, activities, events sections here -->

</div>

<!-- Styles -->
<style>
/* Entire CSS from your previous dashboard code */
.attractive-dashboard {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Welcome Header */
.welcome-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 20px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.welcome-text h1 {
    margin: 0;
    font-size: 2.2rem;
    font-weight: 700;
}

.welcome-text p {
    margin: 10px 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.date-display {
    text-align: right;
}

.current-date {
    font-size: 1.3rem;
    font-weight: 600;
}

.current-time {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 5px;
}

/* Quick Actions */
.quick-actions-section {
    margin-bottom: 30px;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 20px;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.action-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 20px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s;
    border: 2px solid transparent;
}

.action-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    border-color: #4f46e5;
}

.action-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.student-action .action-icon { background: #4f46e5; }
.fee-action .action-icon { background: #10b981; }
.leave-action .action-icon { background: #f59e0b; }
.staff-action .action-icon { background: #ef4444; }

.action-content h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1f2937;
}

.action-content p {
    margin: 5px 0 0 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.action-arrow {
    margin-left: auto;
    color: #9ca3af;
    font-size: 1.2rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .welcome-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    .action-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Live Date & Time Script -->
<script>
function updateDateTime() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').textContent = now.toLocaleDateString(undefined, options);
    document.getElementById('current-time').textContent = now.toLocaleTimeString(undefined, { hour: '2-digit', minute: '2-digit', second: '2-digit' });
}

// Initial call
updateDateTime();

// Update every second
setInterval(updateDateTime, 1000);
</script>

@endsection
