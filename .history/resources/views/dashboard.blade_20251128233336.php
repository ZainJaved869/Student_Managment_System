@extends('layouts.app')

@section('title', 'System Administration')

@section('content')
<div class="admin-container">
    <!-- Header -->
    <div class="admin-header">
        <div class="header-content">
            <h1 class="admin-title">System Administration</h1>
            <p class="admin-subtitle">Manage your institution's core system configuration</p>
        </div>
        <div class="system-status">
            <div class="status-indicator online">
                <i class="fas fa-circle"></i>
                System Online
            </div>
            <div class="last-backup">
                <i class="fas fa-database"></i>
                Last Backup: Today, 02:00 AM
            </div>
        </div>
    </div>

    <!-- System Overview Cards -->
    <div class="system-overview">
        <div class="overview-card">
            <div class="overview-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="overview-content">
                <div class="overview-value">{{ $totalUsers ?? 0 }}</div>
                <div class="overview-label">Total Users</div>
            </div>
        </div>
        <div class="overview-card">
            <div class="overview-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="overview-content">
                <div class="overview-value">{{ $totalStudents ?? 0 }}</div>
                <div class="overview-label">Students</div>
            </div>
        </div>
        <div class="overview-card">
            <div class="overview-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="overview-content">
                <div class="overview-value">{{ $totalStaff ?? 0 }}</div>
                <div class="overview-label">Staff Members</div>
            </div>
        </div>
        <div class="overview-card">
            <div class="overview-icon">
                <i class="fas fa-database"></i>
            </div>
            <div class="overview-content">
                <div class="overview-value">{{ $databaseSize ?? '0' }} MB</div>
                <div class="overview-label">Database Size</div>
            </div>
        </div>
    </div>

    <!-- Administration Tabs -->
    <div class="admin-tabs">
        <div class="tab-navigation">
            <button class="tab-btn active" data-tab="system-config">
                <i class="fas fa-cogs"></i>
                System Configuration
            </button>
            <button class="tab-btn" data-tab="user-management">
                <i class="fas fa-user-cog"></i>
                User Management
            </button>
            <button class="tab-btn" data-tab="academic-setup">
                <i class="fas fa-graduation-cap"></i>
                Academic Setup
            </button>
            <button class="tab-btn" data-tab="data-management">
                <i class="fas fa-database"></i>
                Data Management
            </button>
            <button class="tab-btn" data-tab="system-logs">
                <i class="fas fa-clipboard-list"></i>
                System Logs
            </button>
        </div>

        <div class="tab-content">
            <!-- System Configuration Tab -->
            <div class="tab-pane active" id="system-config">
                <div class="config-section">
                    <h3><i class="fas fa-school"></i> Institution Settings</h3>
                    <div class="config-grid">
                        <div class="config-item">
                            <label>Institution Name</label>
                            <input type="text" value="EduManage Academy" class="form-control">
                        </div>
                        <div class="config-item">
                            <label>Institution Code</label>
                            <input type="text" value="EMA2024" class="form-control">
                        </div>
                        <div class="config-item">
                            <label>Academic Year</label>
                            <select class="form-control">
                                <option>2023-2024</option>
                                <option selected>2024-2025</option>
                                <option>2025-2026</option>
                            </select>
                        </div>
                        <div class="config-item">
                            <label>Current Term</label>
                            <select class="form-control">
                                <option selected>Fall Semester</option>
                                <option>Spring Semester</option>
                                <option>Summer Term</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="config-section">
                    <h3><i class="fas fa-calendar-alt"></i> Academic Calendar</h3>
                    <div class="config-grid">
                        <div class="config-item">
                            <label>Session Start Date</label>
                            <input type="date" value="2024-09-01" class="form-control">
                        </div>
                        <div class="config-item">
                            <label>Session End Date</label>
                            <input type="date" value="2025-06-30" class="form-control">
                        </div>
                        <div class="config-item">
                            <label>Class Start Time</label>
                            <input type="time" value="08:00" class="form-control">
                        </div>
                        <div class="config-item">
                            <label>Class End Time</label>
                            <input type="time" value="15:00" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="config-section">
                    <h3><i class="fas fa-money-bill-wave"></i> Financial Settings</h3>
                    <div class="config-grid">
                        <div class="config-item">
                            <label>Default Currency</label>
                            <select class="form-control">
                                <option selected>USD - US Dollar</option>
                                <option>EUR - Euro</option>
                                <option>GBP - British Pound</option>
                            </select>
                        </div>
                        <div class="config-item">
                            <label>Late Fee Percentage</label>
                            <input type="number" value="2" class="form-control" min="0" max="50" step="0.1">
                        </div>
                        <div class="config-item">
                            <label>Grace Period (Days)</label>
                            <input type="number" value="7" class="form-control" min="0" max="30">
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Management Tab -->
            <div class="tab-pane" id="user-management">
                <div class="section-header">
                    <h3><i class="fas fa-users-cog"></i> User Accounts & Permissions</h3>
                    <button class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Add User
                    </button>
                </div>

                <div class="users-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">JD</div>
                                        <div>
                                            <div class="user-name">John Doe</div>
                                            <div class="user-email">john@edumanage.edu</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge admin">Administrator</span>
                                </td>
                                <td>
                                    <span class="status-badge active">Active</span>
                                </td>
                                <td>Today, 09:24 AM</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon" title="Reset Password">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="btn-icon text-danger" title="Deactivate">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">SM</div>
                                        <div>
                                            <div class="user-name">Sarah Wilson</div>
                                            <div class="user-email">sarah@edumanage.edu</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge teacher">Teacher</span>
                                </td>
                                <td>
                                    <span class="status-badge active">Active</span>
                                </td>
                                <td>Yesterday, 14:30 PM</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon" title="Reset Password">
                                            <i class="fas fa-key"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="config-section">
                    <h3><i class="fas fa-shield-alt"></i> Security Settings</h3>
                    <div class="security-settings">
                        <div class="security-item">
                            <div class="security-info">
                                <h4>Password Policy</h4>
                                <p>Enforce strong password requirements</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="security-item">
                            <div class="security-info">
                                <h4>Two-Factor Authentication</h4>
                                <p>Require 2FA for all administrative users</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="security-item">
                            <div class="security-info">
                                <h4>Session Timeout</h4>
                                <p>Automatically log out inactive users</p>
                            </div>
                            <select class="form-control">
                                <option>15 minutes</option>
                                <option selected>30 minutes</option>
                                <option>1 hour</option>
                                <option>2 hours</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Setup Tab -->
            <div class="tab-pane" id="academic-setup">
                <div class="section-header">
                    <h3><i class="fas fa-book-open"></i> Academic Structure</h3>
                    <div class="header-actions">
                        <button class="btn btn-outline">
                            <i class="fas fa-plus"></i> Add Grade Level
                        </button>
                        <button class="btn btn-outline">
                            <i class="fas fa-plus"></i> Add Subject
                        </button>
                    </div>
                </div>

                <div class="academic-structure">
                    <div class="structure-column">
                        <h4>Grade Levels</h4>
                        <div class="structure-list">
                            @foreach(['Kindergarten', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5'] as $grade)
                            <div class="structure-item">
                                <div class="item-content">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>{{ $grade }}</span>
                                </div>
                                <div class="item-actions">
                                    <button class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="structure-column">
                        <h4>Subjects</h4>
                        <div class="structure-list">
                            @foreach(['Mathematics', 'Science', 'English', 'Social Studies', 'Art', 'Physical Education'] as $subject)
                            <div class="structure-item">
                                <div class="item-content">
                                    <i class="fas fa-book"></i>
                                    <span>{{ $subject }}</span>
                                </div>
                                <div class="item-actions">
                                    <button class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="config-section">
                    <h3><i class="fas fa-chart-line"></i> Grading System</h3>
                    <div class="grading-system">
                        <div class="grading-scale">
                            <h4>Grading Scale</h4>
                            <table class="grading-table">
                                <thead>
                                    <tr>
                                        <th>Grade</th>
                                        <th>Range</th>
                                        <th>Points</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>A+</td>
                                        <td>97-100%</td>
                                        <td>4.0</td>
                                        <td>Excellent</td>
                                    </tr>
                                    <tr>
                                        <td>A</td>
                                        <td>93-96%</td>
                                        <td>4.0</td>
                                        <td>Outstanding</td>
                                    </tr>
                                    <tr>
                                        <td>A-</td>
                                        <td>90-92%</td>
                                        <td>3.7</td>
                                        <td>Very Good</td>
                                    </tr>
                                    <tr>
                                        <td>B+</td>
                                        <td>87-89%</td>
                                        <td>3.3</td>
                                        <td>Good</td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>83-86%</td>
                                        <td>3.0</td>
                                        <td>Above Average</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Management Tab -->
            <div class="tab-pane" id="data-management">
                <div class="data-management">
                    <div class="data-section">
                        <h3><i class="fas fa-database"></i> Database Management</h3>
                        <div class="data-cards">
                            <div class="data-card">
                                <div class="data-icon backup">
                                    <i class="fas fa-download"></i>
                                </div>
                                <div class="data-content">
                                    <h4>Backup Database</h4>
                                    <p>Create a complete backup of all system data</p>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-play"></i> Run Backup
                                    </button>
                                </div>
                            </div>

                            <div class="data-card">
                                <div class="data-icon restore">
                                    <i class="fas fa-upload"></i>
                                </div>
                                <div class="data-content">
                                    <h4>Restore Database</h4>
                                    <p>Restore system from a previous backup</p>
                                    <button class="btn btn-warning">
                                        <i class="fas fa-history"></i> Restore
                                    </button>
                                </div>
                            </div>

                            <div class="data-card">
                                <div class="data-icon export">
                                    <i class="fas fa-file-export"></i>
                                </div>
                                <div class="data-content">
                                    <h4>Export Data</h4>
                                    <p>Export data in various formats (CSV, Excel)</p>
                                    <button class="btn btn-info">
                                        <i class="fas fa-download"></i> Export
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="data-section">
                        <h3><i class="fas fa-trash-alt"></i> Data Cleanup</h3>
                        <div class="cleanup-options">
                            <div class="cleanup-item">
                                <div class="cleanup-info">
                                    <h4>Purge Old Records</h4>
                                    <p>Remove records older than specified period</p>
                                </div>
                                <select class="form-control">
                                    <option>Keep all records</option>
                                    <option>Older than 1 year</option>
                                    <option>Older than 2 years</option>
                                    <option>Older than 5 years</option>
                                </select>
                            </div>

                            <div class="cleanup-item">
                                <div class="cleanup-info">
                                    <h4>Clear Cache</h4>
                                    <p>Clear system cache and temporary files</p>
                                </div>
                                <button class="btn btn-outline">
                                    <i class="fas fa-broom"></i> Clear Cache
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Logs Tab -->
            <div class="tab-pane" id="system-logs">
                <div class="logs-section">
                    <h3><i class="fas fa-clipboard-list"></i> System Activity Logs</h3>
                    
                    <div class="logs-filters">
                        <select class="form-control">
                            <option>All Activities</option>
                            <option>User Logins</option>
                            <option>Data Changes</option>
                            <option>System Events</option>
                        </select>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        <button class="btn btn-outline">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>

                    <div class="logs-list">
                        <div class="log-item">
                            <div class="log-icon success">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="log-content">
                                <div class="log-message">User login: John Doe (Administrator)</div>
                                <div class="log-meta">Today, 09:24 AM • IP: 192.168.1.100</div>
                            </div>
                        </div>

                        <div class="log-item">
                            <div class="log-icon info">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="log-content">
                                <div class="log-message">New student registered: Emma Wilson (Grade 5)</div>
                                <div class="log-meta">Today, 08:45 AM • By: Sarah Wilson</div>
                            </div>
                        </div>

                        <div class="log-item">
                            <div class="log-icon warning">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="log-content">
                                <div class="log-message">Failed login attempt for user: admin</div>
                                <div class="log-meta">Today, 08:30 AM • IP: 192.168.1.150</div>
                            </div>
                        </div>

                        <div class="log-item">
                            <div class="log-icon success">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="log-content">
                                <div class="log-message">Fee payment recorded: Mike Brown - $250.00</div>
                                <div class="log-meta">Yesterday, 16:20 PM • By: System</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="admin-actions">
        <button class="btn btn-success" onclick="saveSystemConfig()">
            <i class="fas fa-save"></i> Save All Changes
        </button>
        <button class="btn btn-outline">
            <i class="fas fa-times"></i> Cancel
        </button>
        <button class="btn btn-danger" onclick="resetToDefaults()">
            <i class="fas fa-undo"></i> Reset to Defaults
        </button>
    </div>
</div>

<style>
.admin-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

/* Header Styles */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
}

.admin-title {
    font-size: 2.25rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.admin-subtitle {
    color: #64748b;
    font-size: 1.1rem;
    margin: 0;
}

.system-status {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.875rem;
}

.status-indicator.online {
    background: #dcfce7;
    color: #166534;
}

.status-indicator.offline {
    background: #fef2f2;
    color: #dc2626;
}

.last-backup {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-size: 0.875rem;
}

/* System Overview */
.system-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.overview-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.overview-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.overview-value {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
}

.overview-label {
    color: #64748b;
    font-weight: 500;
}

/* Tab Navigation */
.admin-tabs {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

.tab-navigation {
    display: flex;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    overflow-x: auto;
}

.tab-btn {
    background: none;
    border: none;
    padding: 1rem 1.5rem;
    color: #64748b;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
    border-bottom: 3px solid transparent;
}

.tab-btn:hover {
    color: #374151;
    background: #f1f5f9;
}

.tab-btn.active {
    color: #667eea;
    background: white;
    border-bottom-color: #667eea;
}

.tab-content {
    padding: 2rem;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

/* Configuration Sections */
.config-section {
    margin-bottom: 2.5rem;
}

.config-section h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.config-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.config-item label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Section Headers */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.section-header h3 {
    margin: 0;
}

/* Users Table */
.users-table {
    background: white;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 2rem;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #f8fafc;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: #374151;
    border-bottom: 1px solid #e2e8f0;
}

.table td {
    padding: 1rem;
    border-bottom: 1px solid #f1f5f9;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
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
}

.user-name {
    font-weight: 600;
    color: #1f2937;
}

.user-email {
    color: #6b7280;
    font-size: 0.875rem;
}

.role-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.role-badge.admin {
    background: #e0e7ff;
    color: #3730a3;
}

.role-badge.teacher {
    background: #d1fae5;
    color: #065f46;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.active {
    background: #dcfce7;
    color: #166534;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-icon {
    background: none;
    border: none;
    padding: 0.5rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #6b7280;
}

.btn-icon:hover {
    background: #f3f4f6;
    color: #374151;
}

.btn-icon.text-danger:hover {
    background: #fef2f2;
    color: #dc2626;
}

/* Security Settings */
.security-settings {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.security-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #f8fafc;
}

.security-info h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 600;
}

.security-info p {
    margin: 0;
    color: #6b7280;
    font-size: 0.9rem;
}

/* Switch Toggle */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #667eea;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

/* Academic Structure */
.academic-structure {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.structure-column h4 {
    margin: 0 0 1rem 0;
    font-weight: 600;
    color: #374151;
}

.structure-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.structure-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: white;
}

.item-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

/* Grading System */
.grading-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
}

.grading-table th,
.grading-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #f1f5f9;
}

.grading-table th {
    background: #f8fafc;
    font-weight: 600;
    color: #374151;
}

/* Data Management */
.data-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.data-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
}

.data-icon {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
}

.data-icon.backup { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
.data-icon.restore { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
.data-icon.export { background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%); }

.data-content h4 {
    margin: 0 0 0.5rem 0;
    font-weight: 600;
}

.data-content p {
    margin: 0 0 1rem 0;
    color: #6b7280;
}

.cleanup-options {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.cleanup-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #f8fafc;
}

/* System Logs */
.logs-filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.logs-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.log-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: white;
}

.log-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
    flex-shrink: 0;
}

.log-icon.success { background: #10b981; }
.log-icon.info { background: #0ea5e9; }
.log-icon.warning { background: #f59e0b; }
.log-icon.error { background: #ef4444; }

.log-message {
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.log-meta {
    color: #6b7280;
    font-size: 0.875rem;
}

/* Action Buttons */
.admin-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
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
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-success { background: #10b981; color: white; }
.btn-warning { background: #f59e0b; color: white; }
.btn-danger { background: #ef4444; color: white; }
.btn-info { background: #0ea5e9; color: white; }
.btn-outline { background: white; border: 1px solid #d1d5db; color: #374151; }

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .admin-container {
        padding: 1rem;
    }
    
    .admin-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .system-overview {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .academic-structure {
        grid-template-columns: 1fr;
    }
    
    .data-cards {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .system-overview {
        grid-template-columns: 1fr;
    }
    
    .config-grid {
        grid-template-columns: 1fr;
    }
    
    .tab-navigation {
        flex-direction: column;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .admin-actions {
        flex-direction: column;
    }
    
    .security-item {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
}
</style>

<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Remove active class from all tabs and panes
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));
            
            // Add active class to current tab and pane
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });
});

function saveSystemConfig() {
    // Show loading state
    const saveBtn = document.querySelector('.btn-success');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    saveBtn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        // Show success message
        showNotification('System configuration saved successfully!', 'success');
        
        // Restore button
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    }, 2000);
}

function resetToDefaults() {
    if (confirm('Are you sure you want to reset all settings to default values? This action cannot be undone.')) {
        showNotification('Settings reset to default values.', 'info');
    }
}

function showNotification(message, type = 'info') {
    // Simple notification implementation
    alert(message);
}
</script>
@endsection