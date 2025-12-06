<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - EduManage Pro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            min-height: 100vh;
            position: fixed;
        }
        .sidebar-header {
            text-align: center;
            padding: 1rem;
        }
        .sidebar-header img.sidebar-avatar,
        .sidebar-header .sidebar-avatar-placeholder {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 0.5rem auto;
            object-fit: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar-header h4 {
            margin: 0;
            font-size: 1.1rem;
        }
        .sidebar-header p {
            margin: 0;
            font-size: 0.8rem;
            color: #bdc3c7;
        }
        .sidebar-menu {
            margin-top: 1rem;
        }
        .menu-item, .submenu-item {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            color: white;
            text-decoration: none;
        }
        .menu-item.active, .submenu-item.active {
            background: #34495e;
        }
        .menu-item i, .submenu-item i {
            margin-right: 0.5rem;
        }

        /* Header styles */
        .header {
            margin-left: 250px;
            background: #f8f9fa;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .user-info {
            display: flex;
            align-items: center;
        }
        .header .user-info .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 0.5rem;
            font-size: 1rem;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 2rem;
        }
    </style>
</head>
<body>

@php
    $authUser = auth()->user();
@endphp

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        @if($authUser->profile_picture)
            <img src="{{ asset('storage/profile-pictures/' . $authUser->profile_picture) }}" class="sidebar-avatar" alt="Avatar">
        @else
            <div class="sidebar-avatar-placeholder">{{ strtoupper(substr($authUser->name, 0, 1)) }}</div>
        @endif
        <h4>{{ $authUser->name }}</h4>
        <p>{{ is_object($authUser->role) ? $authUser->role->name : 'No Role Assigned' }}</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
        </a>

        <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i><span>Profile & Settings</span>
        </a>

        <!-- Add other menu items here -->
    </div>
</div>

<!-- Header -->
<div class="header">
    <div class="header-left">
        <h1>@yield('title', 'Dashboard')</h1>
    </div>
    <div class="header-right">
        <div class="user-info">
            <div class="user-avatar">
                @if($authUser->profile_picture)
                    <img src="{{ asset('storage/profile-pictures/' . $authUser->profile_picture) }}" class="avatar-img" alt="Avatar">
                @else
                    {{ strtoupper(substr($authUser->name,0,1)) }}
                @endif
            </div>
            <div>
                <div>{{ $authUser->name }}</div>
                <div style="font-size: 0.8rem; color: #6c757d;">
                    {{ is_object($authUser->role) ? $authUser->role->name : 'No Role Assigned' }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content-wrapper">
    @yield('content')
</div>

</body>
</html>
