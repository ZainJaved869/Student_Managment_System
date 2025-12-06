<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage Pro - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #059669;
            --dark: #0f172a;
            --dark-2: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #cbd5e1;
            --gradient-primary: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --radius-md: 12px;
            --radius-lg: 16px;
            --sidebar-width: 250px;
            --header-height: 70px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            background-color: var(--dark);
            color: var(--light);
            line-height: 1.6;
            display: flex;
            min-height: 100vh;
        }
        
        .container {
            display: flex;
            width: 100%;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--gradient-dark);
            color: var(--light);
            height: 100vh;
            position: fixed;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .logo-text {
            font-size: 1.3rem;
            font-weight: 700;
        }
        
        .sidebar-menu {
            padding: 15px 0;
        }
        
        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            cursor: pointer;
            border-left: 4px solid transparent;
            text-decoration: none;
            color: var(--light);
        }
        
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--primary);
        }
        
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--primary);
        }
        
        .menu-item i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 25px;
            text-align: center;
        }
        
        .menu-item .chevron {
            margin-left: auto;
            font-size: 0.8rem;
            transition: transform 0.3s;
        }
        
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        .submenu.active {
            max-height: 300px;
        }
        
        .submenu-item {
            padding: 10px 20px 10px 50px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: var(--light);
        }
        
        .submenu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .submenu-item i {
            font-size: 0.9rem;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            background-color: var(--dark);
        }
        
        .header {
            height: var(--header-height);
            background-color: var(--dark-2);
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .header-left h1 {
            font-size: 1.5rem;
            color: var(--light);
        }
        
        .header-right {
            display: flex;
            align-items: center;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .panel-selector {
            display: flex;
            background-color: var(--dark);
            border-radius: var(--radius-md);
            overflow: hidden;
            margin-right: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .panel-btn {
            padding: 8px 15px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            color: var(--gray-light);
        }
        
        .panel-btn.active {
            background-color: var(--primary);
            color: white;
        }
        
        .content {
            padding: 20px;
        }
        
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background-color: var(--dark-2);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            padding: 20px;
            transition: transform 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }
        
        .card-stats {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--light);
        }
        
        .card-title {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .card-students .card-icon {
            background: var(--gradient-primary);
        }
        
        .card-staff .card-icon {
            background: linear-gradient(135deg, var(--secondary), #047857);
        }
        
        .card-fees .card-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        
        .card-leaves .card-icon {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
        }
        
        .section {
            background-color: var(--dark-2);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .section-title {
            font-size: 1.3rem;
            color: var(--light);
        }
        
        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .btn i {
            margin-right: 5px;
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--secondary), #047857);
            color: white;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--light);
        }
        
        .table th {
            background-color: var(--dark);
            color: var(--light);
            font-weight: 600;
        }
        
        .table tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }
        
        .status-approved {
            background-color: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        
        .status-rejected {
            background-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .badge-success {
            background-color: var(--secondary);
            color: white;
        }
        
        .badge-warning {
            background-color: #f59e0b;
            color: white;
        }
        
        .badge-danger {
            background-color: #ef4444;
            color: white;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--gray-light);
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: var(--dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-md);
            font-size: 14px;
            color: var(--light);
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .form-control::placeholder {
            color: var(--gray);
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -10px;
            margin-left: -10px;
        }
        
        .form-col {
            flex: 1;
            padding: 0 10px;
        }
        
        .tab-container {
            margin-top: 20px;
        }
        
        .tabs {
            display: flex;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            color: var(--gray);
        }
        
        .tab.active {
            border-bottom: 3px solid var(--primary);
            color: var(--primary);
            font-weight: 500;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .panel-content {
            display: none;
        }
        
        .panel-content.active {
            display: block;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #4ade80;
        }
        
        .alert-danger {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
            color: #fca5a5;
        }
        
        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            color: #fbbf24;
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                overflow: visible;
            }
            
            .sidebar-header h2, .menu-item span, .submenu-item span {
                display: none;
            }
            
            .menu-item {
                justify-content: center;
                padding: 15px;
            }
            
            .menu-item i {
                margin-right: 0;
                font-size: 1.3rem;
            }
            
            .submenu-item {
                padding: 10px 15px;
                justify-content: center;
            }
            
            .main-content {
                margin-left: 70px;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .header-left h1 {
                font-size: 1.2rem;
            }
            
            .panel-selector {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="logo-text">EduManage Pro</div>
                </div>
            </div>
            
            <div class="sidebar-menu">
                <a href="#" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Student Management</span>
                    <i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="submenu">
                    <a href="#" class="submenu-item">
                        <i class="fas fa-list"></i>
                        <span>All Students</span>
                    </a>
                    <a href="#" class="submenu-item">
                        <i class="fas fa-plus"></i>
                        <span>Add Student</span>
                    </a>
                    <a href="#" class="submenu-item">
                        <i class="fas fa-edit"></i>
                        <span>Edit Student</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Staff Management</span>
                    <i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="submenu">
                    <a href="#" class="submenu-item">
                        <i class="fas fa-list"></i>
                        <span>All Staff</span>
                    </a>
                    <a href="#" class="submenu-item">
                        <i class="fas fa-plus"></i>
                        <span>Add Staff</span>
                    </a>
                </div>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Fee Management</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Attendance</span>
                </a>
                
                <a href="#" class="menu-item">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Examinations</span>
                </a>
                
                <div class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                    <i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="submenu">
                    <a href="#" class="submenu-item">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile</span>
                    </a>
                    <a href="#" class="submenu-item">
                        <i class="fas fa-lock"></i>
                        <span>Security</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="header-left">
                    <h1>Dashboard</h1>
                </div>
                
                <div class="header-right">
                    <div class="panel-selector">
                        <div class="panel-btn active" data-panel="admin">Admin</div>
                        <div class="panel-btn" data-panel="teacher">Teacher</div>
                        <div class="panel-btn" data-panel="student">Student</div>
                    </div>
                    
                    <div class="user-info">
                        <div class="user-avatar">JD</div>
                        <div>
                            <div>John Doe</div>
                            <div style="font-size: 0.8rem; color: var(--gray);">Administrator</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                @if(session('success'))
                    <div class="alert alert-success animate-fade-in-up">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger animate-fade-in-up">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <!-- Dashboard Cards -->
                <div class="dashboard-cards animate-fade-in-up">
                    <div class="card card-students">
                        <div class="card-header">
                            <div>
                                <div class="card-stats">1,254</div>
                                <div class="card-title">Total Students</div>
                            </div>
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card card-staff">
                        <div class="card-header">
                            <div>
                                <div class="card-stats">84</div>
                                <div class="card-title">Teaching Staff</div>
                            </div>
                            <div class="card-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card card-fees">
                        <div class="card-header">
                            <div>
                                <div class="card-stats">₹245,680</div>
                                <div class="card-title">Fees Collected</div>
                            </div>
                            <div class="card-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card card-leaves">
                        <div class="card-header">
                            <div>
                                <div class="card-stats">12</div>
                                <div class="card-title">Pending Leaves</div>
                            </div>
                            <div class="card-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities Section -->
                <div class="section animate-fade-in-up">
                    <div class="section-header">
                        <h2 class="section-title">Recent Activities</h2>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Activity
                        </a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Activity</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>New Student Registration</td>
                                    <td>John Smith</td>
                                    <td>24 May 2023</td>
                                    <td><span class="status status-approved">Approved</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Leave Application</td>
                                    <td>Sarah Johnson</td>
                                    <td>23 May 2023</td>
                                    <td><span class="status status-pending">Pending</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fee Payment</td>
                                    <td>Michael Brown</td>
                                    <td>22 May 2023</td>
                                    <td><span class="status status-approved">Approved</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Staff Onboarding</td>
                                    <td>Emily Davis</td>
                                    <td>21 May 2023</td>
                                    <td><span class="status status-rejected">Rejected</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Upcoming Events Section -->
                <div class="section animate-fade-in-up">
                    <div class="section-header">
                        <h2 class="section-title">Upcoming Events</h2>
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                            Add Event
                        </a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Participants</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Annual Sports Day</td>
                                    <td>30 May 2023</td>
                                    <td>School Ground</td>
                                    <td><span class="badge badge-primary">All Students</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Parent-Teacher Meeting</td>
                                    <td>5 June 2023</td>
                                    <td>Main Hall</td>
                                    <td><span class="badge badge-success">Grade 10</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Science Exhibition</td>
                                    <td>12 June 2023</td>
                                    <td>Science Lab</td>
                                    <td><span class="badge badge-warning">Grade 8-12</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle submenus
            document.querySelectorAll('.menu-item').forEach(item => {
                if (item.querySelector('.chevron')) {
                    item.addEventListener('click', function(e) {
                        // Prevent default only for menu items with dropdowns
                        if (!this.getAttribute('href')) {
                            e.preventDefault();
                        }
                        const submenu = this.nextElementSibling;
                        if (submenu && submenu.classList.contains('submenu')) {
                            submenu.classList.toggle('active');
                            
                            const icon = this.querySelector('.chevron');
                            if (submenu.classList.contains('active')) {
                                icon.classList.remove('fa-chevron-down');
                                icon.classList.add('fa-chevron-up');
                            } else {
                                icon.classList.remove('fa-chevron-up');
                                icon.classList.add('fa-chevron-down');
                            }
                        }
                    });
                }
            });

            // Panel switching
            document.querySelectorAll('.panel-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.panel-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.panel-content').forEach(p => p.classList.remove('active'));
                    
                    this.classList.add('active');
                    const panelId = this.getAttribute('data-panel') + '-panel';
                    document.getElementById(panelId).classList.add('active');
                });
            });

            // Auto-expand active submenus
            const currentPath = window.location.pathname;
            document.querySelectorAll('.submenu-item').forEach(item => {
                if (item.href && currentPath === new URL(item.href).pathname) {
                    item.classList.add('active');
                    const parentMenu = item.closest('.submenu');
                    if (parentMenu) {
                        parentMenu.classList.add('active');
                        const menuItem = parentMenu.previousElementSibling;
                        if (menuItem) {
                            const icon = menuItem.querySelector('.chevron');
                            if (icon) {
                                icon.classList.remove('fa-chevron-down');
                                icon.classList.add('fa-chevron-up');
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>