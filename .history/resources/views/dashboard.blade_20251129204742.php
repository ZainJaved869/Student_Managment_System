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
            <div class="current-date">{{ now()->format('l, F j, Y') }}</div>
            <div class="current-time">{{ now()->format('h:i A') }}</div>
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

   

<style>
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

/* Main Stats Grid */
.stats-grid-main {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
    border-left: 5px solid;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.student-card { border-left-color: #4f46e5; }
.staff-card { border-left-color: #10b981; }
.fee-card { border-left-color: #f59e0b; }
.leave-card { border-left-color: #ef4444; }

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
}

.student-card .stat-icon { background: #4f46e5; }
.staff-card .stat-icon { background: #10b981; }
.fee-card .stat-icon { background: #f59e0b; }
.leave-card .stat-icon { background: #ef4444; }

.stat-number {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1f2937;
    line-height: 1;
}

.stat-label {
    color: #6b7280;
    font-size: 0.95rem;
    margin: 5px 0;
}

.stat-trend {
    font-size: 0.85rem;
    font-weight: 600;
    margin-top: 8px;
}

.stat-trend.positive { color: #10b981; }
.stat-trend.negative { color: #ef4444; }
.stat-trend.warning { color: #f59e0b; }

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

/* Content Grid */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 30px;
    margin-bottom: 30px;
}

/* Charts */
.chart-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 25px;
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.chart-header h3 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 600;
    color: #1f2937;
}

.chart-legend {
    display: flex;
    gap: 15px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.85rem;
    color: #6b7280;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 2px;
}

.legend-color.current { background: #4f46e5; }
.legend-color.previous { background: #9ca3af; }

.chart-percentage {
    font-weight: 600;
    color: #10b981;
}

.chart-container {
    height: 250px;
    position: relative;
}

/* Progress Bar */
.progress-container {
    margin-top: 20px;
}

.progress-bar {
    width: 100%;
    height: 12px;
    background: #f3f4f6;
    border-radius: 10px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #10b981, #34d399);
    border-radius: 10px;
    transition: width 0.5s ease;
}

.progress-stats {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
    font-size: 0.9rem;
    color: #6b7280;
}

/* Activity Card */
.activity-card, .leaves-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 25px;
}

.activity-header, .leaves-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.activity-header h3, .leaves-header h3 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 600;
    color: #1f2937;
}

.view-all {
    color: #4f46e5;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
}

.badge {
    background: #ef4444;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.activity-list, .leaves-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8fafc;
    border-radius: 10px;
    transition: background 0.3s;
}

.activity-item:hover {
    background: #f1f5f9;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.activity-icon.success { background: #10b981; }
.activity-icon.primary { background: #4f46e5; }
.activity-icon.warning { background: #f59e0b; }
.activity-icon.info { background: #06b6d4; }

.activity-content p {
    margin: 0;
    font-weight: 500;
    color: #1f2937;
}

.activity-time {
    font-size: 0.8rem;
    color: #9ca3af;
    margin-top: 2px;
}

/* Leaves */
.leave-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8fafc;
    border-radius: 10px;
}

.leave-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #4f46e5;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.9rem;
}

.leave-details h4 {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
}

.leave-details p {
    margin: 2px 0;
    color: #6b7280;
    font-size: 0.85rem;
}

.leave-date {
    font-size: 0.8rem;
    color: #9ca3af;
}

.leave-actions {
    margin-left: auto;
    display: flex;
    gap: 5px;
}

.btn-approve, .btn-reject {
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.8rem;
    transition: all 0.3s;
}

.btn-approve {
    background: #d1fae5;
    color: #065f46;
}

.btn-reject {
    background: #fee2e2;
    color: #991b1b;
}

.btn-approve:hover { background: #a7f3d0; }
.btn-reject:hover { background: #fecaca; }

/* Events */
.events-section {
    margin-bottom: 30px;
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.event-card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.3s;
}

.event-card:hover {
    transform: translateY(-3px);
}

.event-date {
    text-align: center;
    background: #f8fafc;
    padding: 15px;
    border-radius: 10px;
    min-width: 60px;
}

.event-day {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
}

.event-month {
    display: block;
    font-size: 0.8rem;
    color: #6b7280;
    font-weight: 600;
}

.event-details h4 {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
}

.event-details p {
    margin: 5px 0 0 0;
    color: #6b7280;
    font-size: 0.85rem;
}

.event-badge {
    margin-left: auto;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.event-badge.primary { background: #e0e7ff; color: #3730a3; }
.event-badge.success { background: #d1fae5; color: #065f46; }
.event-badge.warning { background: #fef3c7; color: #92400e; }

/* Responsive */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .right-column {
        order: -1;
    }
}

@media (max-width: 768px) {
    .attractive-dashboard {
        padding: 15px;
    }
    
    .welcome-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .stats-grid-main {
        grid-template-columns: 1fr;
    }
    
    .action-grid {
        grid-template-columns: 1fr;
    }
    
    .events-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enrollment Chart
    const ctxEnroll = document.getElementById('enrollmentChart').getContext('2d');
    new Chart(ctxEnroll, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Current Year',
                    data: [1200, 1250, 1300, 1350, 1400, 1450, 1500, 1550, 1600, 1650, 1700, 1750],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Previous Year',
                    data: [1100, 1150, 1200, 1220, 1250, 1280, 1300, 1320, 1350, 1380, 1400, 1420],
                    borderColor: '#9ca3af',
                    backgroundColor: 'rgba(156, 163, 175, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    borderDash: [5, 5]
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>
@endsection