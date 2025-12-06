@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">

    <!-- Header / Welcome -->
    <div class="dashboard-header">
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p>Role: {{ ucfirst(auth()->user()->role) ?? 'Administrator' }}</p>
        <div class="current-date">
            <i class="fas fa-calendar-alt"></i>
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Overview Cards -->
    <div class="overview-cards">
        <div class="card">
            <div class="card-icon student">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="card-content">
                <div class="value">{{ $totalStudents }}</div>
                <div class="label">Total Students</div>
                <div class="trend {{ $studentTrend >= 0 ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $studentTrend >= 0 ? 'up' : 'down' }}"></i>
                    {{ abs($studentTrend) }}% from last month
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-icon teacher">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="card-content">
                <div class="value">{{ $totalTeachers }}</div>
                <div class="label">Teachers</div>
                <div class="trend {{ $teacherTrend >= 0 ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $teacherTrend >= 0 ? 'up' : 'down' }}"></i>
                    {{ abs($teacherTrend) }}% from last month
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-icon staff">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-content">
                <div class="value">{{ $totalStaff }}</div>
                <div class="label">Staff Members</div>
                <div class="trend {{ $staffTrend >= 0 ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $staffTrend >= 0 ? 'up' : 'down' }}"></i>
                    {{ abs($staffTrend) }}% from last month
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-icon revenue">
                <i class="fas fa-coins"></i>
            </div>
            <div class="card-content">
                <div class="value">${{ number_format($pendingFees) }}</div>
                <div class="label">Pending Fees</div>
                <div class="trend {{ $feeTrend >= 0 ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $feeTrend >= 0 ? 'up' : 'down' }}"></i>
                    {{ abs($feeTrend) }}% from last month
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h3>Quick Actions</h3>
        <div class="action-buttons">
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add Student
            </a>
            <a href="{{ route('teachers.create') }}" class="btn btn-info">
                <i class="fas fa-user-plus"></i> Add Teacher
            </a>
            <a href="{{ route('attendance.create') }}" class="btn btn-warning">
                <i class="fas fa-clipboard-check"></i> Take Attendance
            </a>
            <a href="{{ route('fees.create') }}" class="btn btn-success">
                <i class="fas fa-money-bill-wave"></i> Record Payment
            </a>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                <i class="fas fa-file-export"></i> Generate Report
            </a>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Left Column -->
        <div class="dashboard-column">
            <!-- Upcoming Events -->
            <div class="dashboard-widget">
                <div class="widget-header">
                    <h3><i class="fas fa-calendar-day"></i> Upcoming Events</h3>
                    <a href="{{ route('events.create') }}" class="btn-icon">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="widget-content">
                    @if($upcomingEvents->count() > 0)
                        <div class="events-list">
                            @foreach($upcomingEvents as $event)
                            <div class="event-item">
                                <div class="event-date">
                                    <div class="date-day">{{ $event->event_date->format('d') }}</div>
                                    <div class="date-month">{{ $event->event_date->format('M') }}</div>
                                </div>
                                <div class="event-details">
                                    <div class="event-title">{{ $event->title }}</div>
                                    <div class="event-time">
                                        <i class="fas fa-clock"></i>
                                        {{ $event->start_time->format('h:i A') }} - {{ $event->end_time->format('h:i A') }}
                                    </div>
                                    <div class="event-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $event->location ?? 'TBA' }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-calendar-times"></i>
                            <p>No upcoming events</p>
                            <a href="{{ route('events.create') }}" class="btn btn-outline">Create Event</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="dashboard-widget">
                <div class="widget-header">
                    <h3><i class="fas fa-history"></i> Recent Activity</h3>
                    <a href="{{ route('activity-logs.index') }}" class="btn-text">View All</a>
                </div>
                <div class="widget-content">
                    @if($recentActivities->count() > 0)
                        <div class="activity-list">
                            @foreach($recentActivities as $activity)
                            <div class="activity-item">
                                <div class="activity-icon {{ $activity->type }}">
                                    <i class="fas fa-{{ $activity->getIcon() }}"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-message">{{ $activity->description }}</div>
                                    <div class="activity-meta">
                                        <span class="user">{{ $activity->causer->name ?? 'System' }}</span>
                                        • <span class="time">{{ $activity->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-history"></i>
                            <p>No recent activity</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="dashboard-column">
            <!-- Charts -->
            <div class="dashboard-widget">
                <div class="widget-header">
                    <h3><i class="fas fa-chart-line"></i> Enrollment Trend</h3>
                    <select id="enrollmentPeriod" class="form-control-sm">
                        <option value="30">Last 30 Days</option>
                        <option value="90">Last 3 Months</option>
                        <option value="365">Last Year</option>
                    </select>
                </div>
                <div class="widget-content">
                    <canvas id="enrollmentChart" height="250"></canvas>
                </div>
            </div>

            <div class="dashboard-widget">
                <div class="widget-header">
                    <h3><i class="fas fa-money-bill-wave"></i> Fee Collection</h3>
                    <select id="feePeriod" class="form-control-sm">
                        <option value="30">Last 30 Days</option>
                        <option value="90">Last 3 Months</option>
                        <option value="365">Last Year</option>
                    </select>
                </div>
                <div class="widget-content">
                    <canvas id="feeChart" height="250"></canvas>
                </div>
            </div>

            <!-- Recent Students -->
            <div class="dashboard-widget">
                <div class="widget-header">
                    <h3><i class="fas fa-user-graduate"></i> Recently Added Students</h3>
                    <a href="{{ route('students.index') }}" class="btn-text">View All</a>
                </div>
                <div class="widget-content">
                    @if($recentStudents->count() > 0)
                        <div class="students-list">
                            @foreach($recentStudents as $student)
                            <div class="student-item">
                                <div class="student-avatar">
                                    {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                                </div>
                                <div class="student-info">
                                    <div class="student-name">{{ $student->first_name }} {{ $student->last_name }}</div>
                                    <div class="student-details">
                                        <span class="grade">Grade {{ $student->grade_level }}</span>
                                        • <span class="date">Joined {{ $student->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="student-status {{ $student->is_active ? 'active' : 'inactive' }}">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-user-graduate"></i>
                            <p>No students found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

/* Header Styles */
.dashboard-header {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
}

.dashboard-header h1 {
    font-size: 2.25rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.25rem 0;
}

.dashboard-header p {
    color: #64748b;
    font-size: 1.1rem;
    margin: 0 0 0.5rem 0;
}

.current-date {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #f1f5f9;
    border-radius: 8px;
    color: #64748b;
    font-weight: 500;
}

/* Overview Cards */
.overview-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.card-icon.student { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.card-icon.teacher { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.card-icon.staff { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
.card-icon.revenue { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }

.card-content {
    flex: 1;
}

.card .value {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.card .label {
    color: #64748b;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.trend {
    font-size: 0.75rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.trend.positive { color: #10b981; }
.trend.negative { color: #ef4444; }

/* Quick Actions */
.quick-actions {
    margin-bottom: 2rem;
}

.quick-actions h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 1rem 0;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

/* Buttons */
.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
.btn-info { background: #0ea5e9; color: white; }
.btn-warning { background: #f59e0b; color: white; }
.btn-success { background: #10b981; color: white; }
.btn-secondary { background: #6b7280; color: white; }
.btn-outline { background: white; border: 1px solid #d1d5db; color: #374151; }

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-icon {
    background: none;
    border: none;
    padding: 0.5rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #6b7280;
    text-decoration: none;
}

.btn-icon:hover {
    background: #f3f4f6;
    color: #374151;
}

.btn-text {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.875rem;
}

.btn-text:hover {
    text-decoration: underline;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.dashboard-column {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Widget Styles */
.dashboard-widget {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

.widget-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    background: #f8fafc;
}

.widget-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.widget-content {
    padding: 1.5rem;
}

/* Events List */
.events-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.event-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #f8fafc;
}

.event-date {
    text-align: center;
    padding: 0.5rem;
    background: white;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
    min-width: 50px;
}

.date-day {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
}

.date-month {
    font-size: 0.75rem;
    color: #64748b;
    text-transform: uppercase;
    font-weight: 600;
}

.event-details {
    flex: 1;
}

.event-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.event-time, .event-location {
    font-size: 0.875rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.125rem;
}

/* Activity List */
.activity-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #f8fafc;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    flex-shrink: 0;
}

.activity-icon.login { background: #10b981; }
.activity-icon.create { background: #0ea5e9; }
.activity-icon.update { background: #f59e0b; }
.activity-icon.delete { background: #ef4444; }
.activity-icon.system { background: #6b7280; }

.activity-content {
    flex: 1;
}

.activity-message {
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.activity-meta {
    font-size: 0.875rem;
    color: #6b7280;
}

.activity-meta .user {
    font-weight: 500;
}

/* Students List */
.students-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.student-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #f8fafc;
}

.student-avatar {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.student-info {
    flex: 1;
}

.student-name {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.student-details {
    font-size: 0.875rem;
    color: #6b7280;
}

.student-status {
    width: 12px;
    height: 12px;
}

.student-status.active { color: #10b981; }
.student-status.inactive { color: #ef4444; }

/* Empty State */
.empty-state {
    text-align: center;
    padding: 2rem;
    color: #6b7280;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state p {
    margin: 0 0 1rem 0;
}

/* Form Controls */
.form-control-sm {
    padding: 0.375rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 0.875rem;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .dashboard-container {
        padding: 1rem;
    }
}

@media (max-width: 768px) {
    .overview-cards {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .card {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enrollment Chart
    const ctxEnroll = document.getElementById('enrollmentChart').getContext('2d');
    const enrollmentChart = new Chart(ctxEnroll, {
        type: 'line',
        data: {
            labels: @json($enrollmentChart['labels']),
            datasets: [{
                label: 'New Enrollments',
                data: @json($enrollmentChart['data']),
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
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

    // Fee Collection Chart
    const ctxFee = document.getElementById('feeChart').getContext('2d');
    const feeChart = new Chart(ctxFee, {
        type: 'bar',
        data: {
            labels: @json($feeChart['labels']),
            datasets: [{
                label: 'Fees Collected ($)',
                data: @json($feeChart['data']),
                backgroundColor: '#10b981',
                borderColor: '#10b981',
                borderWidth: 1
            }]
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
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
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

    // Period selectors
    document.getElementById('enrollmentPeriod').addEventListener('change', function() {
        updateChartData(this.value, 'enrollment');
    });

    document.getElementById('feePeriod').addEventListener('change', function() {
        updateChartData(this.value, 'fee');
    });

    function updateChartData(days, type) {
        fetch(`/api/dashboard/chart-data?type=${type}&days=${days}`)
            .then(response => response.json())
            .then(data => {
                if (type === 'enrollment') {
                    enrollmentChart.data.labels = data.labels;
                    enrollmentChart.data.datasets[0].data = data.data;
                    enrollmentChart.update();
                } else {
                    feeChart.data.labels = data.labels;
                    feeChart.data.datasets[0].data = data.data;
                    feeChart.update();
                }
            });
    }
});
</script>
@endsection