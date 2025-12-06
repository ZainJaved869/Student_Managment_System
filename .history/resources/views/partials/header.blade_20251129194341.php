<!-- Header -->
<div class="header">
    <div class="header-left">
        <h1>@yield('title', 'Dashboard Overview')</h1>
    </div>
    <div class="header-right">
        <div class="panel-selector">
            <div class="panel-btn active" data-panel="admin">Admin</div>
            <div class="panel-btn" data-panel="student">Student</div>
            <div class="panel-btn" data-panel="staff">Staff</div>
            <div class="panel-btn" data-panel="parent">Parent</div>
        </div>
        <div class="user-info">
            <div class="user-avatar">JD</div>
            <div>
                <div>John Doe</div>
                <div style="font-size: 0.8rem; color: #6c757d;">Administrator</div>
            </div>
        </div>
    </div>
</div>