<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage Pro - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* All the CSS from the original code goes here */
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            /* ... rest of the CSS ... */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            @include('partials.header')

            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // All the JavaScript from the original code goes here
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle submenus
            document.querySelectorAll('.menu-item').forEach(item => {
                if (item.querySelector('.fa-chevron-down')) {
                    item.addEventListener('click', function() {
                        const submenu = this.nextElementSibling;
                        submenu.classList.toggle('active');
                        
                        const icon = this.querySelector('.fa-chevron-down');
                        if (submenu.classList.contains('active')) {
                            icon.classList.remove('fa-chevron-down');
                            icon.classList.add('fa-chevron-up');
                        } else {
                            icon.classList.remove('fa-chevron-up');
                            icon.classList.add('fa-chevron-down');
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
        });
    </script>
    
    @yield('scripts')
</body>
</html>