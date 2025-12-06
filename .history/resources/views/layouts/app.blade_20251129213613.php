<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>EduManage Pro - @yield('title', 'Dashboard')</title>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Theme CSS (dark gradient matching login) -->
    <style>
        /* Palette taken from your login page */
        :root{
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #059669;
            --dark: #0f172a;
            --dark-2: #111827;
            --panel: #0b1220; /* slightly lighter for panels */
            --muted: #94a3b8;
            --light: #f8fafc;
            --glass: rgba(255,255,255,0.03);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.25), 0 4px 6px -2px rgba(0,0,0,0.2);
            --radius-lg: 12px;
            --radius-md: 10px;
            --sidebar-width: 260px;
            --header-height: 72px;
        }

        *{box-sizing:border-box;margin:0;padding:0;font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;}

        html,body{height:100%;background: linear-gradient(135deg, #0b1220 0%, #071021 60%); color: #e6eef8; -webkit-font-smoothing:antialiased;}

        /* layout */
        .container { display:flex; min-height:100vh; width:100%; }

        /* Sidebar area (the partial will render content inside) */
        .sidebar { width: var(--sidebar-width); flex-shrink:0; background: linear-gradient(180deg, rgba(13,18,27,0.9), rgba(5,9,14,0.95)); border-right: 1px solid rgba(255,255,255,0.03); position:fixed; height:100vh; overflow:auto; padding-bottom:40px; }
        .main-content { margin-left: var(--sidebar-width); flex:1; display:flex; flex-direction:column; min-height:100vh; }

        /* Header */
        .header {
            height: var(--header-height);
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding: 12px 22px;
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border-bottom: 1px solid rgba(255,255,255,0.02);
            backdrop-filter: blur(6px);
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .header-left h1 { font-size:1.25rem; color: var(--light); letter-spacing: -0.2px; }
        .header-right { display:flex; align-items:center; gap:14px; }

        /* Panel selector match login */
        .panel-selector { display:flex; gap:8px; background: rgba(255,255,255,0.02); padding:4px; border-radius:8px; }
        .panel-btn { padding:8px 12px; cursor:pointer; color:var(--muted); border-radius:8px; font-weight:600; font-size:0.9rem; }
        .panel-btn.active { background: linear-gradient(90deg,var(--primary),var(--primary-dark)); color:white; box-shadow: 0 6px 18px rgba(37,99,235,0.18); }

        /* user-info */
        .user-info { display:flex; align-items:center; gap:12px; color:var(--light); }
        .user-avatar, .avatar-img { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; color:white; background: linear-gradient(135deg,var(--primary),var(--primary-dark)); }
        .avatar-img img{ width:100%; height:100%; object-fit:cover; border-radius:12px; }

        /* content area */
        .content { padding: 26px; flex:1; }

        /* card / section */
        .section { background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border-radius: var(--radius-lg); padding:18px; margin-bottom:20px; box-shadow: 0 8px 30px rgba(2,6,23,0.45); border:1px solid rgba(255,255,255,0.02); }
        .section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; }
        .section-title { color:var(--light); font-size:1.1rem; }

        /* buttons */
        .btn { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:10px; cursor:pointer; text-decoration:none; font-weight:600; }
        .btn-primary { background: linear-gradient(90deg,var(--primary),var(--primary-dark)); color:white; box-shadow: 0 8px 24px rgba(37,99,235,0.14); border: none; }
        .btn-outline { background: transparent; color: var(--light); border: 1px solid rgba(255,255,255,0.04); }

        /* forms / inputs */
        .form-control { width:100%; padding:10px 12px; border-radius:8px; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.03); color:var(--light); }
        .form-label { color:var(--muted); margin-bottom:6px; display:block; font-weight:600; }

        /* profile specific */
        .profile-img { width:120px; height:120px; border-radius:16px; object-fit:cover; border: 3px solid rgba(255,255,255,0.04); }
        .profile-placeholder { width:120px; height:120px; border-radius:16px; display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:800;background: linear-gradient(135deg,var(--primary),var(--primary-dark)); color:white; border:3px solid rgba(255,255,255,0.04); }

        /* tables */
        .table { width:100%; border-collapse:collapse; color:var(--light); }
        .table th, .table td { padding:10px 12px; border-bottom:1px solid rgba(255,255,255,0.03); text-align:left; }
        .table th { color:var(--muted); font-weight:700; font-size:0.85rem; }

        /* responsive tweaks */
        @media (max-width: 992px){
            .sidebar { width:76px; }
            .main-content { margin-left:76px; }
            .sidebar .sidebar-header h2, .sidebar .sidebar-header p, .menu-item span { display:none; }
        }
        @media (max-width: 768px){
            .panel-selector { display:none; }
            .header { padding:10px 12px; }
            .content { padding:16px; }
        }

        /* small helpers */
        .muted { color: var(--muted); }
        .badge { padding:6px 10px; border-radius:999px; font-weight:700; font-size:0.8rem; }
        .badge-success { background: rgba(5,150,105,0.12); color:var(--secondary); border:1px solid rgba(5,150,105,0.06); }
    </style>
</head>
<body>
    <div class="container">
        {{-- Keep same structure: include partials (they must be safe as we discussed) --}}
        @include('partials.sidebar')

        <div class="main-content">
            @include('partials.header')

            <div class="content">
                @if(session('success'))
                    <div class="section" style="border-left:4px solid rgba(37,99,235,0.9); padding:12px 14px; margin-bottom:18px;">
                        <strong style="color:var(--light)">{{ session('success') }}</strong>
                    </div>
                @endif

                @if(session('error'))
                    <div class="section" style="border-left:4px solid rgba(220,38,38,0.9); padding:12px 14px; margin-bottom:18px;">
                        <strong style="color:var(--light)">{{ session('error') }}</strong>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Minimal JS copied from your original for submenus/panels (no structural changes) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle submenus (works if your partial sidebar uses .menu-item + .submenu)
            document.querySelectorAll('.menu-item').forEach(item => {
                const submenu = item.nextElementSibling;
                if(submenu && submenu.classList.contains('submenu')){
                    item.addEventListener('click', function(e){
                        e.preventDefault();
                        submenu.classList.toggle('active');
                        const icon = item.querySelector('.fa-chevron-down, .fa-chevron-up');
                        if(submenu.classList.contains('active')){
                            if(icon){ icon.classList.remove('fa-chevron-down'); icon.classList.add('fa-chevron-up'); }
                        } else {
                            if(icon){ icon.classList.remove('fa-chevron-up'); icon.classList.add('fa-chevron-down'); }
                        }
                    });
                }
            });

            // Panel switching (header)
            document.querySelectorAll('.panel-btn').forEach(btn=>{
                btn.addEventListener('click', function(){
                    document.querySelectorAll('.panel-btn').forEach(b=>b.classList.remove('active'));
                    this.classList.add('active');
                    // optional: show/hide panels with ids if present
                });
            });

            // Auto expand submenu for active link
            const currentPath = window.location.pathname;
            document.querySelectorAll('.submenu-item').forEach(item=>{
                try {
                    if(item.href && (new URL(item.href)).pathname === currentPath){
                        item.classList.add('active');
                        const parent = item.closest('.submenu');
                        if(parent){ parent.classList.add('active'); const trigger = parent.previousElementSibling; if(trigger){ const icon = trigger.querySelector('.fa-chevron-down'); if(icon){ icon.classList.remove('fa-chevron-down'); icon.classList.add('fa-chevron-up'); } } }
                    }
                } catch(e){}
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
