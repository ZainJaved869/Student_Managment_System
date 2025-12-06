<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevShare Hub')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Left Section: Logo & Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                <!-- Mobile Menu Button -->
                <button id="mobileMenuButton" class="lg:hidden text-gray-600 hover:text-primary focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-primary">
                    <i class="fas fa-code-branch mr-2"></i>DevShare Hub
                </a>
            </div>

            <!-- Center Section: Search Bar (Desktop) -->
            <div class="hidden lg:flex flex-1 max-w-2xl mx-8">
                <form action="{{ route('projects.index') }}" method="GET" class="w-full">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search projects..." 
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                        >
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
            </div>

            <!-- Right Section: User Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Desktop User Menu -->
                    <div class="hidden lg:flex items-center space-x-4">
                        <a href="{{ route('projects.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition duration-300">
                            <i class="fas fa-plus mr-2"></i>Upload Project
                        </a>
                        
                        <!-- User Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-600 hover:text-primary transition duration-300">
                                @if(Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                         alt="Profile" 
                                         class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 hidden group-hover:block z-50">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-600 hover:bg-blue-50 hover:text-primary transition duration-300">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <a href="{{ route('projects.my-projects') }}" class="block px-4 py-2 text-gray-600 hover:bg-blue-50 hover:text-primary transition duration-300">
                                    <i class="fas fa-folder mr-2"></i>My Projects
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-blue-50 hover:text-primary transition duration-300">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile User Icon -->
                    <div class="lg:hidden">
                        <button id="mobileUserMenu" class="text-gray-600 hover:text-primary">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                     alt="Profile" 
                                     class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                            @endif
                        </button>
                    </div>

                @else
                    <!-- Guest Menu -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary transition duration-300">Login</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition duration-300">Sign Up</a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Mobile Search Bar -->
        <div class="lg:hidden px-4 pb-3">
            <form action="{{ route('projects.index') }}" method="GET">
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search projects..." 
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                    >
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </form>
        </div>
    </nav>

    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <!-- Sidebar Header -->
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Navigation</h2>
        </div>

        <!-- Sidebar Content -->
        <div class="p-4 overflow-y-auto h-full">
            <!-- Main Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-primary transition duration-300">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('projects.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-primary transition duration-300">
                    <i class="fas fa-rocket w-5"></i>
                    <span>Browse Projects</span>
                </a>

                <a href="{{ route('projects.create') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-primary transition duration-300">
                    <i class="fas fa-cloud-upload-alt w-5"></i>
                    <span>Upload Project</span>
                </a>

                <a href="{{ route('projects.my-projects') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-primary transition duration-300">
                    <i class="fas fa-folder w-5"></i>
                    <span>My Projects</span>
                </a>
            </nav>

            <!-- Categories Section -->
            <div class="mt-8">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Categories</h3>
                <nav class="space-y-1">
                    <a href="{{ route('projects.index') }}?category=web" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-50 text-gray-600 hover:text-primary transition duration-300">
                        <i class="fas fa-globe w-5"></i>
                        <span>Web Development</span>
                    </a>
                    <a href="{{ route('projects.index') }}?category=mobile" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-50 text-gray-600 hover:text-primary transition duration-300">
                        <i class="fas fa-mobile-alt w-5"></i>
                        <span>Mobile Apps</span>
                    </a>
                    <a href="{{ route('projects.index') }}?category=desktop" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-50 text-gray-600 hover:text-primary transition duration-300">
                        <i class="fas fa-desktop w-5"></i>
                        <span>Desktop Apps</span>
                    </a>
                    <a href="{{ route('projects.index') }}?category=ai" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-50 text-gray-600 hover:text-primary transition duration-300">
                        <i class="fas fa-robot w-5"></i>
                        <span>AI & Machine Learning</span>
                    </a>
                </nav>
            </div>

            <!-- Quick Filters -->
            <div class="mt-8">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Filters</h3>
                <nav class="space-y-1">
                    <a href="{{ route('projects.index') }}?price=free" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-50 text-gray-600 hover:text-primary transition duration-300">
                        <i class="fas fa-tag w-5 text-green-500"></i>
                        <span>Free Projects</span>
                    </a>
                    <a href="{{ route('projects.index') }}?price=paid" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-50 text-gray-600 hover:text-primary transition duration-300">
                        <i class="fas fa-dollar-sign w-5 text-yellow-500"></i>
                        <span>Paid Projects</span>
                    </a>
                    <a href="{{ route('projects.index') }}?featured=true" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-50 text-gray-600 hover:text-primary transition duration-300">
                        <i class="fas fa-star w-5 text-yellow-500"></i>
                        <span>Featured</span>
                    </a>
                </nav>
            </div>

            <!-- User Section (Mobile) -->
            @auth
            <div class="mt-8 pt-6 border-t border-gray-200 lg:hidden">
                <div class="flex items-center space-x-3 p-3">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                             alt="Profile" 
                             class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    @endif
                    <div>
                        <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="mt-2 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center space-x-3 p-2 rounded-lg hover:bg-red-50 text-red-600 transition duration-300">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-20 min-h-screen">
        <div class="p-6">
            @yield('content')
        </div>
    </main>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mobileUserMenu = document.getElementById('mobileUserMenu');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        mobileMenuButton.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking on links (mobile)
        sidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Mobile user menu toggle
        if (mobileUserMenu) {
            mobileUserMenu.addEventListener('click', () => {
                alert('User menu clicked - you can add a dropdown here');
            });
        }
    </script>

    <!-- Additional Styles -->
    <style>
        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Custom scrollbar for sidebar */
        #sidebar::-webkit-scrollbar {
            width: 4px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</body>
</html>