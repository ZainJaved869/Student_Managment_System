<!-- Header -->
<div class="header">

    <div class="header-left">
        <h1>@yield('title', 'Dashboard Overview')</h1>
    </div>

    <div class="header-right">

        <!-- Removed: admin/student/staff/parent panel buttons -->
        <!-- You said you no longer want that navigation -->
        <!-- If you want them back as route links, tell me -->

        <div class="user-info">
            <!-- User Avatar -->
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <!-- User Name + Role -->
            <div>
                <div>{{ auth()->user()->name }}</div>

                <div style="font-size: 0.8rem; color: #6c757d;">
                    {{ auth()->user()->role ?? 'User' }}
                </div>
            </div>
        </div>

    </div>
</div>
