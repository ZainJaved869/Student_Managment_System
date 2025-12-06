@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
<div class="settings-container">
    <!-- Header -->
    <div class="settings-header">
        <div class="header-content">
            <h1 class="settings-title">System Settings</h1>
            <p class="settings-subtitle">Manage your institution's configuration and preferences</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="saveAllSettings()">
                <i class="fas fa-save"></i> Save All Changes
            </button>
        </div>
    </div>

    <!-- Settings Navigation -->
    <div class="settings-nav">
        <div class="nav-tabs">
            <button class="nav-tab active" data-tab="general">
                <i class="fas fa-cog"></i> General
            </button>
            <button class="nav-tab" data-tab="academic">
                <i class="fas fa-graduation-cap"></i> Academic
            </button>
            <button class="nav-tab" data-tab="financial">
                <i class="fas fa-money-bill-wave"></i> Financial
            </button>
            <button class="nav-tab" data-tab="notifications">
                <i class="fas fa-bell"></i> Notifications
            </button>
            <button class="nav-tab" data-tab="security">
                <i class="fas fa-shield-alt"></i> Security
            </button>
            <button class="nav-tab" data-tab="backup">
                <i class="fas fa-database"></i> Backup & Restore
            </button>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="settings-content">
        <!-- General Settings -->
        <div class="settings-tab active" id="general-tab">
            <div class="settings-section">
                <h3 class="section-title">Institution Information</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Institution Name</label>
                        <input type="text" class="setting-input" value="EduManage Academy" placeholder="Enter institution name">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Institution Code</label>
                        <input type="text" class="setting-input" value="EMA2024" placeholder="Unique institution code">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Contact Email</label>
                        <input type="email" class="setting-input" value="admin@edumanage.edu" placeholder="Primary contact email">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Phone Number</label>
                        <input type="tel" class="setting-input" value="+1 (555) 123-4567" placeholder="Contact phone number">
                    </div>
                    <div class="setting-group full-width">
                        <label class="setting-label">Address</label>
                        <textarea class="setting-textarea" placeholder="Institution address">123 Education Street, Learning City, LC 12345</textarea>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">System Configuration</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Default Language</label>
                        <select class="setting-select">
                            <option value="en" selected>English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Time Zone</label>
                        <select class="setting-select">
                            <option value="UTC-5" selected>Eastern Time (ET)</option>
                            <option value="UTC-6">Central Time (CT)</option>
                            <option value="UTC-7">Mountain Time (MT)</option>
                            <option value="UTC-8">Pacific Time (PT)</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Date Format</label>
                        <select class="setting-select">
                            <option value="MM/DD/YYYY" selected>MM/DD/YYYY</option>
                            <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                            <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Currency</label>
                        <select class="setting-select">
                            <option value="USD" selected>US Dollar ($)</option>
                            <option value="EUR">Euro (€)</option>
                            <option value="GBP">British Pound (£)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Appearance</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Theme</label>
                        <div class="theme-options">
                            <label class="theme-option">
                                <input type="radio" name="theme" value="light" checked>
                                <div class="theme-preview light-theme">
                                    <i class="fas fa-sun"></i>
                                    <span>Light</span>
                                </div>
                            </label>
                            <label class="theme-option">
                                <input type="radio" name="theme" value="dark">
                                <div class="theme-preview dark-theme">
                                    <i class="fas fa-moon"></i>
                                    <span>Dark</span>
                                </div>
                            </label>
                            <label class="theme-option">
                                <input type="radio" name="theme" value="auto">
                                <div class="theme-preview auto-theme">
                                    <i class="fas fa-adjust"></i>
                                    <span>Auto</span>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Primary Color</label>
                        <div class="color-picker">
                            <input type="color" id="primary-color" value="#667eea">
                            <label for="primary-color" class="color-preview" style="background: #667eea;"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Settings -->
        <div class="settings-tab" id="academic-tab">
            <div class="settings-section">
                <h3 class="section-title">Academic Year & Terms</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Current Academic Year</label>
                        <select class="setting-select">
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025" selected>2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Current Term</label>
                        <select class="setting-select">
                            <option value="fall" selected>Fall Semester</option>
                            <option value="spring">Spring Semester</option>
                            <option value="summer">Summer Term</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Grading System</label>
                        <select class="setting-select">
                            <option value="percentage" selected>Percentage (0-100%)</option>
                            <option value="gpa">GPA (4.0 Scale)</option>
                            <option value="letter">Letter Grades</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Passing Grade</label>
                        <input type="number" class="setting-input" value="60" min="0" max="100" step="1">
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Attendance Settings</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Minimum Attendance %</label>
                        <input type="number" class="setting-input" value="75" min="0" max="100" step="1">
                        <span class="setting-help">Students below this percentage will be flagged</span>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Auto-mark Absent After</label>
                        <input type="number" class="setting-input" value="15" min="0" step="1">
                        <span class="setting-help">Minutes after class start time</span>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Working Days per Week</label>
                        <div class="checkbox-group">
                            <label><input type="checkbox" checked> Monday</label>
                            <label><input type="checkbox" checked> Tuesday</label>
                            <label><input type="checkbox" checked> Wednesday</label>
                            <label><input type="checkbox" checked> Thursday</label>
                            <label><input type="checkbox" checked> Friday</label>
                            <label><input type="checkbox"> Saturday</label>
                            <label><input type="checkbox"> Sunday</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Class & Schedule Settings</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Default Class Duration</label>
                        <input type="number" class="setting-input" value="45" min="15" step="5">
                        <span class="setting-help">Minutes per class period</span>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Maximum Students per Class</label>
                        <input type="number" class="setting-input" value="30" min="1" step="1">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">School Start Time</label>
                        <input type="time" class="setting-input" value="08:00">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">School End Time</label>
                        <input type="time" class="setting-input" value="15:00">
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Settings -->
        <div class="settings-tab" id="financial-tab">
            <div class="settings-section">
                <h3 class="section-title">Fee Management</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Default Currency</label>
                        <select class="setting-select">
                            <option value="USD" selected>US Dollar ($)</option>
                            <option value="EUR">Euro (€)</option>
                            <option value="INR">Indian Rupee (₹)</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Tax Rate (%)</label>
                        <input type="number" class="setting-input" value="0" min="0" max="50" step="0.1">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Late Fee Penalty</label>
                        <input type="number" class="setting-input" value="2" min="0" step="0.1">
                        <span class="setting-help">Percentage of due amount per month</span>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Grace Period (Days)</label>
                        <input type="number" class="setting-input" value="7" min="0" step="1">
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Payment Methods</h3>
                <div class="settings-grid">
                    <div class="setting-group full-width">
                        <label class="setting-label">Enabled Payment Methods</label>
                        <div class="payment-methods">
                            <label class="payment-method">
                                <input type="checkbox" checked>
                                <div class="payment-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <span>Cash</span>
                            </label>
                            <label class="payment-method">
                                <input type="checkbox" checked>
                                <div class="payment-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <span>Credit Card</span>
                            </label>
                            <label class="payment-method">
                                <input type="checkbox" checked>
                                <div class="payment-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <span>Bank Transfer</span>
                            </label>
                            <label class="payment-method">
                                <input type="checkbox">
                                <div class="payment-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <span>Mobile Payment</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Invoice & Receipt Settings</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Invoice Prefix</label>
                        <input type="text" class="setting-input" value="INV" placeholder="e.g., INV">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Next Invoice Number</label>
                        <input type="number" class="setting-input" value="1001" min="1">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Receipt Footer Text</label>
                        <textarea class="setting-textarea" placeholder="Additional text to display on receipts">Thank you for your payment!</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications Settings -->
        <div class="settings-tab" id="notifications-tab">
            <div class="settings-section">
                <h3 class="section-title">Email Notifications</h3>
                <div class="notification-settings">
                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Fee Due Reminders</h4>
                            <p>Send automatic reminders for due fees</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Attendance Alerts</h4>
                            <p>Notify when student attendance falls below threshold</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Grade Updates</h4>
                            <p>Send notifications when new grades are published</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Leave Approvals</h4>
                            <p>Notify staff about leave request status</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">SMS Notifications</h3>
                <div class="notification-settings">
                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Emergency Alerts</h4>
                            <p>Critical system alerts via SMS</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Fee Due SMS</h4>
                            <p>Send fee due reminders via SMS</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Notification Schedule</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Fee Reminder Days</label>
                        <input type="number" class="setting-input" value="3" min="1" max="30">
                        <span class="setting-help">Days before due date to send reminders</span>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Daily Digest Time</label>
                        <input type="time" class="setting-input" value="18:00">
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="settings-tab" id="security-tab">
            <div class="settings-section">
                <h3 class="section-title">Authentication & Access</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Session Timeout</label>
                        <select class="setting-select">
                            <option value="15">15 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="60" selected>1 hour</option>
                            <option value="120">2 hours</option>
                            <option value="240">4 hours</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Max Login Attempts</label>
                        <input type="number" class="setting-input" value="5" min="1" max="10">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Password Expiry (Days)</label>
                        <input type="number" class="setting-input" value="90" min="30" step="1">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Two-Factor Authentication</label>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                        <span class="setting-help">Require 2FA for all users</span>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Data Privacy</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Auto-logout Inactive Users</label>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">IP Restriction</label>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                        <span class="setting-help">Allow access only from specific IP ranges</span>
                    </div>
                    <div class="setting-group full-width">
                        <label class="setting-label">Allowed IP Ranges</label>
                        <textarea class="setting-textarea" placeholder="Enter IP addresses or ranges (one per line)">192.168.1.0/24
10.0.0.0/8</textarea>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Audit Log</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Log Retention Period</label>
                        <select class="setting-select">
                            <option value="30">30 days</option>
                            <option value="90">90 days</option>
                            <option value="180" selected>6 months</option>
                            <option value="365">1 year</option>
                            <option value="730">2 years</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Log User Activities</label>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backup & Restore -->
        <div class="settings-tab" id="backup-tab">
            <div class="settings-section">
                <h3 class="section-title">Automated Backups</h3>
                <div class="settings-grid">
                    <div class="setting-group">
                        <label class="setting-label">Backup Frequency</label>
                        <select class="setting-select">
                            <option value="daily" selected>Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Backup Time</label>
                        <input type="time" class="setting-input" value="02:00">
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Retain Backups For</label>
                        <select class="setting-select">
                            <option value="7">7 days</option>
                            <option value="30" selected>30 days</option>
                            <option value="90">90 days</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">Backup Location</label>
                        <select class="setting-select">
                            <option value="local" selected>Local Server</option>
                            <option value="cloud">Cloud Storage</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Manual Operations</h3>
                <div class="backup-actions">
                    <button class="btn btn-success" onclick="createBackup()">
                        <i class="fas fa-download"></i> Create Backup Now
                    </button>
                    <button class="btn btn-warning" onclick="restoreBackup()">
                        <i class="fas fa-upload"></i> Restore from Backup
                    </button>
                    <button class="btn btn-danger" onclick="exportData()">
                        <i class="fas fa-file-export"></i> Export Data
                    </button>
                </div>
            </div>

            <div class="settings-section">
                <h3 class="section-title">Recent Backups</h3>
                <div class="backup-list">
                    <div class="backup-item">
                        <div class="backup-info">
                            <h4>backup_2024_11_28_120000.zip</h4>
                            <p>Created: Today, 12:00 PM • Size: 45.2 MB</p>
                        </div>
                        <div class="backup-actions">
                            <button class="btn btn-sm btn-outline" title="Download">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn btn-sm btn-outline" title="Restore">
                                <i class="fas fa-undo"></i>
                            </button>
                            <button class="btn btn-sm btn-outline btn-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="backup-item">
                        <div class="backup-info">
                            <h4>backup_2024_11_27_120000.zip</h4>
                            <p>Created: Yesterday, 12:00 PM • Size: 44.8 MB</p>
                        </div>
                        <div class="backup-actions">
                            <button class="btn btn-sm btn-outline" title="Download">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn btn-sm btn-outline" title="Restore">
                                <i class="fas fa-undo"></i>
                            </button>
                            <button class="btn btn-sm btn-outline btn-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.settings-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

/* Header Styles */
.settings-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
}

.settings-title {
    font-size: 2.25rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.settings-subtitle {
    color: #64748b;
    font-size: 1.1rem;
    margin: 0;
}

/* Navigation Tabs */
.settings-nav {
    margin-bottom: 2rem;
}

.nav-tabs {
    display: flex;
    gap: 0.5rem;
    border-bottom: 1px solid #e2e8f0;
    flex-wrap: wrap;
}

.nav-tab {
    background: none;
    border: none;
    padding: 1rem 1.5rem;
    color: #64748b;
    font-weight: 500;
    cursor: pointer;
    border-radius: 8px 8px 0 0;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.nav-tab:hover {
    color: #374151;
    background: #f8fafc;
}

.nav-tab.active {
    color: #667eea;
    background: white;
    border-bottom: 3px solid #667eea;
}

/* Settings Content */
.settings-content {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
}

.settings-tab {
    display: none;
    padding: 2rem;
}

.settings-tab.active {
    display: block;
}

.settings-section {
    margin-bottom: 3rem;
}

.settings-section:last-child {
    margin-bottom: 0;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 1.5rem 0;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #f1f5f9;
}

/* Settings Grid */
.settings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.setting-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.setting-group.full-width {
    grid-column: 1 / -1;
}

.setting-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.95rem;
}

.setting-input, .setting-select, .setting-textarea {
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.setting-input:focus, .setting-select:focus, .setting-textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.setting-textarea {
    resize: vertical;
    min-height: 100px;
}

.setting-help {
    font-size: 0.875rem;
    color: #6b7280;
}

/* Theme Options */
.theme-options {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.theme-option input {
    display: none;
}

.theme-preview {
    padding: 1rem 1.5rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.theme-option input:checked + .theme-preview {
    border-color: #667eea;
    background: #f8fafc;
}

.light-theme { color: #374151; }
.dark-theme { color: #1f2937; background: #374151; color: white; }
.auto-theme { color: #6b7280; }

/* Color Picker */
.color-picker {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.color-picker input[type="color"] {
    width: 0;
    height: 0;
    opacity: 0;
    position: absolute;
}

.color-preview {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.color-preview:hover {
    transform: scale(1.1);
}

/* Checkbox Group */
.checkbox-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 0.75rem;
}

.checkbox-group label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    font-weight: 500;
}

/* Payment Methods */
.payment-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.payment-method {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    padding: 1.5rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.payment-method input {
    display: none;
}

.payment-method input:checked + .payment-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.payment-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    background: #f3f4f6;
    color: #6b7280;
    transition: all 0.3s ease;
}

.payment-method:hover {
    border-color: #667eea;
}

/* Notifications */
.notification-settings {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.notification-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.notification-item:hover {
    border-color: #667eea;
    background: #f8fafc;
}

.notification-info h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 600;
    color: #1f2937;
}

.notification-info p {
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

/* Backup Actions */
.backup-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.backup-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.backup-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: #f8fafc;
}

.backup-info h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 600;
    color: #1f2937;
}

.backup-info p {
    margin: 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.backup-actions {
    display: flex;
    gap: 0.5rem;
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
.btn-outline { background: white; border: 1px solid #d1d5db; color: #374151; }

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .settings-container {
        padding: 1rem;
    }
    
    .settings-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .nav-tabs {
        flex-direction: column;
    }
    
    .settings-grid {
        grid-template-columns: 1fr;
    }
    
    .backup-actions {
        flex-direction: column;
    }
    
    .backup-item {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .payment-methods {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Tab Navigation
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.nav-tab');
    const tabContents = document.querySelectorAll('.settings-tab');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Add active class to current tab and content
            this.classList.add('active');
            document.getElementById(`${tabName}-tab`).classList.add('active');
        });
    });
});

// Save Settings Function
function saveAllSettings() {
    // Show loading state
    const saveBtn = document.querySelector('.btn-primary');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    saveBtn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        // Show success message
        showNotification('Settings saved successfully!', 'success');
        
        // Restore button
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    }, 2000);
}

// Backup Functions
function createBackup() {
    showNotification('Creating backup...', 'info');
    // Simulate backup process
    setTimeout(() => {
        showNotification('Backup created successfully!', 'success');
    }, 3000);
}

function restoreBackup() {
    showNotification('Please select a backup file to restore.', 'info');
}

function exportData() {
    showNotification('Preparing data export...', 'info');
    // Simulate export process
    setTimeout(() => {
        showNotification('Data exported successfully!', 'success');
    }, 2000);
}

// Notification System
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${getNotificationIcon(type)}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    // Add styles for notification
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border-left: 4px solid ${getNotificationColor(type)};
        display: flex;
        align-items: center;
        gap: 1rem;
        z-index: 1000;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

function getNotificationIcon(type) {
    const icons = {
        success: 'check-circle',
        error: 'exclamation-circle',
        warning: 'exclamation-triangle',
        info: 'info-circle'
    };
    return icons[type] || 'info-circle';
}

function getNotificationColor(type) {
    const colors = {
        success: '#10b981',
        error: '#ef4444',
        warning: '#f59e0b',
        info: '#3b82f6'
    };
    return colors[type] || '#3b82f6';
}

// Add CSS for slideIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection