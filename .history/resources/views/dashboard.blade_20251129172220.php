@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">

    <!-- Role Selector -->
    @if(auth()->user()->role === 'administrator')
    <div class="role-selector">
        <button class="role-btn active" data-role="administrator">Administrator</button>
        <button class="role-btn" data-role="teacher">Teacher</button>
        <button class="role-btn" data-role="student">Student</button>
        <button class="role-btn" data-role="parent">Parent</button>
    </div>
    @endif

    <!-- Header / Welcome -->
    <div class="dashboard-header">
        <h1>Welcome, {{ auth()->user()->name ?? 'User' }}</h1>
        <p>Role: {{ ucfirst(auth()->user()->role ?? 'administrator') }}</p>
    </div>

    <!-- Overview Cards -->
    <div class="overview-cards">
        @if(in_array(auth()->user()->role, ['administrator', 'teacher']))
        <div class="card student-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>12%</span>
                </div>
            </div>
            <div class="card-value">{{ $totalStudents ?? 0 }}</div>
            <div class="card-label">Total Students</div>
        </div>
        @endif

        @if(in_array(auth()->user()->role, ['administrator']))
        <div class="card teacher-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>5%</span>
                </div>
            </div>
            <div class="card-value">{{ $totalTeachers ?? 0 }}</div>
            <div class="card-label">Total Teachers</div>
        </div>
        @endif

        @if(in_array(auth()->user()->role, ['administrator']))
        <div class="card staff-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    <span>2%</span>
                </div>
            </div>
            <div class="card-value">{{ $totalStaff ?? 0 }}</div>
            <div class="card-label">Staff Members</div>
        </div>
        @endif

        @if(in_array(auth()->user()->role, ['administrator', 'parent']))
        <div class="card fees-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>18%</span>
                </div>
            </div>
            <div class="card-value">${{ number_format($pendingFees ?? 0) }}</div>
            <div class="card-label">Pending Fees</div>
        </div>
        @endif

        <!-- Student-specific cards -->
        @if(auth()->user()->role === 'student')
        <div class="card student-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>8%</span>
                </div>
            </div>
            <div class="card-value">85%</div>
            <div class="card-label">Overall Grade</div>
        </div>

        <div class="card teacher-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="card-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    <span>2</span>
                </div>
            </div>
            <div class="card-value">3</div>
            <div class="card-label">Pending Assignments</div>
        </div>
        @endif

        <!-- Parent-specific cards -->
        @if(auth()->user()->role === 'parent')
        <div class="card student-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-child"></i>
                </div>
                <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>1</span>
                </div>
            </div>
            <div class="card-value">2</div>
            <div class="card-label">Children Enrolled</div>
        </div>

        <div class="card teacher-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="card-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    <span>0</span>
                </div>
            </div>
            <div class="card-value">5</div>
            <div class="card-label">Teacher Messages</div>
        </div>
        @endif
    </div>

    <!-- Quick Actions -->
    @if(in_array(auth()->user()->role, ['administrator', 'teacher']))
    <div class="quick-actions">
        <h3 class="section-title">
            <i class="fas fa-bolt"></i>
            Quick Actions
        </h3>
        <div class="action-buttons">
            @if(auth()->user()->role === 'administrator')
            <button class="btn btn-primary">
                <i class="fas fa-user-plus"></i>
                Add Student
            </button>
            <button class="btn btn-info">
                <i class="fas fa-user-plus"></i>
                Add Teacher
            </button>
            @endif
            <button class="btn btn-success">
                <i class="fas fa-file-export"></i>
                Export Data
            </button>
            @if(auth()->user()->role === 'teacher')
            <button class="btn btn-warning">
                <i class="fas fa-tasks"></i>
                Create Assignment
            </button>
            @endif
        </div>
    </div>
    @endif

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <!-- Charts -->
        @if(in_array(auth()->user()->role, ['administrator', 'teacher']))
        <div class="chart-container">
            <h3 class="section-title">
                <i class="fas fa-chart-line"></i>
                Enrollment Trend
            </h3>
            <canvas id="enrollmentChart"></canvas>
        </div>
        @endif

        <!-- Upcoming Events -->
        <div class="events-container">
            <h3 class="section-title">
                <i class="fas fa-calendar-alt"></i>
                Upcoming Events
            </h3>
            <ul class="events-list">
                @forelse(($events ?? []) as $event)
                <li class="event-item">
                    <div class="event-date">
                        <div class="day">{{ $event->date->format('d') }}</div>
                        <div class="month">{{ $event->date->format('M') }}</div>
                    </div>
                    <div class="event-details">
                        <h4>{{ $event->title }}</h4>
                        <p>{{ $event->date->format('l, F j, Y') }}</p>
                    </div>
                </li>
                @empty
                <li class="event-item">
                    <div class="event-details">
                        <h4>No upcoming events</h4>
                        <p>Check back later for new events</p>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>

        <!-- Recent Activity -->
        <div class="activity-container">
            <h3 class="section-title">
                <i class="fas fa-history"></i>
                Recent Activity
            </h3>
            <ul class="activity-list">
                @forelse(($recentLogs ?? []) as $log)
                <li class="activity-item">
                    <div class="activity-time">
                        {{ $log->created_at->format('H:i') }}
                    </div>
                    <div class="activity-details">
                        <h4>{{ $log->message }}</h4>
                        <p>{{ $log->created_at->diffForHumans() }}</p>
                    </div>
                </li>
                @empty
                <li class="activity-item">
                    <div class="activity-details">
                        <h4>No recent activity</h4>
                        <p>Activity will appear here</p>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Additional Charts Row -->
    @if(in_array(auth()->user()->role, ['administrator']))
    <div class="charts-row">
        <div class="chart-wrapper">
            <h3 class="section-title">
                <i class="fas fa-chart-bar"></i>
                Fee Collection
            </h3>
            <canvas id="feeChart"></canvas>
        </div>
        <div class="chart-wrapper">
            <h3 class="section-title">
                <i class="fas fa-chart-pie"></i>
                Student Distribution
            </h3>
            <canvas id="distributionChart"></canvas>
        </div>
    </div>
    @endif
</div>

<style>
:root {
    --primary: #4361ee;
    --secondary: #3f37c9;
    --success: #4cc9f0;
    --info: #4895ef;
    --warning: #f72585;
    --light: #f8f9fa;
    --dark: #212529;
    --sidebar-width: 250px;
    --header-height: 70px;
    --card-radius: 16px;
    --transition: all 0.3s ease;
}

.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

.dashboard-header h1 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.dashboard-header p {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

/* Role Selector */
.role-selector {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    background: white;
    padding: 1rem;
    border-radius: var(--card-radius);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.role-btn {
    padding: 0.7rem 1.5rem;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    background: white;
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
}

.role-btn.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.role-btn:hover {
    border-color: var(--primary);
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
    border-radius: var(--card-radius);
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: var(--transition);
    border-left: 4px solid var(--primary);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.card-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.student-card .card-icon { background: linear-gradient(135deg, #4361ee, #3a0ca3); }
.teacher-card .card-icon { background: linear-gradient(135deg, #f72585, #b5179e); }
.staff-card .card-icon { background: linear-gradient(135deg, #4cc9f0, #4895ef); }
.fees-card .card-icon { background: linear-gradient(135deg, #7209b7, #560bad); }

.card-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--dark);
}

.card-label {
    color: #666;
    font-size: 0.9rem;
}

.card-trend {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

.trend-up { color: #4ade80; }
.trend-down { color: #f87171; }

/* Quick Actions */
.quick-actions {
    background: white;
    border-radius: var(--card-radius);
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title i {
    color: var(--primary);
}

.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.5rem;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-info {
    background: var(--info);
    color: white;
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-warning {
    background: var(--warning);
    color: white;
}

.btn:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.chart-container, .events-container, .activity-container {
    background: white;
    border-radius: var(--card-radius);
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.chart-container {
    grid-column: 1;
}

.events-container, .activity-container {
    grid-column: 2;
}

.events-list, .activity-list {
    list-style: none;
}

.event-item, .activity-item {
    padding: 1rem 0;
    border-bottom: 1px solid #eee;
    display: flex;
    gap: 1rem;
}

.event-item:last-child, .activity-item:last-child {
    border-bottom: none;
}

.event-date, .activity-time {
    min-width: 60px;
    text-align: center;
}

.event-date .day {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
}

.event-date .month {
    font-size: 0.8rem;
    color: #666;
}

.activity-time {
    color: #666;
    font-size: 0.9rem;
}

.event-details h4, .activity-details h4 {
    margin-bottom: 0.3rem;
    font-size: 1rem;
}

.event-details p, .activity-details p {
    color: #666;
    font-size: 0.9rem;
}

/* Charts Row */
.charts-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.chart-wrapper {
    background: white;
    border-radius: var(--card-radius);
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

/* Responsive */
@media (max-width: 1024px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .events-container, .activity-container {
        grid-column: 1;
    }
    
    .charts-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }
    
    .overview-cards {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .role-selector {
        flex-wrap: wrap;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enrollment Chart
    const ctxEnroll = document.getElementById('enrollmentChart');
    if (ctxEnroll) {
        const enrollmentData = @json($enrollmentData ?? ['labels' => [], 'data' => []]);
        new Chart(ctxEnroll, {
            type: 'line',
            data: {
                labels: enrollmentData.labels,
                datasets: [{
                    label: 'Enrollments',
                    data: enrollmentData.data,
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Fee Chart
    const ctxFee = document.getElementById('feeChart');
    if (ctxFee) {
        const feeData = @json($feeData ?? ['labels' => [], 'data' => []]);
        new Chart(ctxFee, {
            type: 'bar',
            data: {
                labels: feeData.labels,
                datasets: [{
                    label: 'Fees Collected',
                    data: feeData.data,
                    backgroundColor: '#7209b7'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // Distribution Chart
    const ctxDist = document.getElementById('distributionChart');
    if (ctxDist) {
        new Chart(ctxDist, {
            type: 'doughnut',
            data: {
                labels: ['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5'],
                datasets: [{
                    data: [25, 20, 15, 22, 18],
                    backgroundColor: [
                        '#4361ee',
                        '#3a0ca3',
                        '#7209b7',
                        '#f72585',
                        '#4cc9f0'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Role switching functionality
    const roleButtons = document.querySelectorAll('.role-btn');
    roleButtons.forEach(button => {
        button.addEventListener('click', function() {
            roleButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // In a real application, you would make an AJAX request to update the dashboard
            // For now, we'll just show an alert
            const role = this.getAttribute('data-role');
            alert(`Switching to ${role} view. In a real app, this would update the dashboard content.`);
        });
    });
});
</script>
@endsection