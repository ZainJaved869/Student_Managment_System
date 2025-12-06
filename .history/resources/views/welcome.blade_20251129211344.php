<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage Pro - Enterprise Student Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --secondary: #059669;
            --accent: #d97706;
            --dark: #0f172a;
            --dark-2: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #cbd5e1;
            --success: #10b981;
            --warning: #f59e0b;
            --gradient-primary: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            --gradient-secondary: linear-gradient(135deg, #059669 0%, #047857 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--dark);
            color: var(--light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header & Navigation */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000;
            padding: 1rem 0;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--light);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--gray-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--light);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: var(--gradient-dark);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(37, 99, 235, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(5, 150, 105, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(217, 119, 6, 0.05) 0%, transparent 50%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 120px 20px 80px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text {
            max-width: 600px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-light);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 2rem;
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-description {
            font-size: 1.25rem;
            color: var(--gray-light);
            margin-bottom: 2.5rem;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            border-radius: var(--radius-md);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: var(--light);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hero-visual {
            position: relative;
        }

        .dashboard-preview {
            background: rgba(30, 41, 59, 0.6);
            border-radius: var(--radius-xl);
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-xl);
            transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
            transition: transform 0.5s ease;
        }

        .dashboard-preview:hover {
            transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
        }

        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .preview-nav {
            display: flex;
            gap: 1rem;
        }

        .preview-nav-item {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gray);
        }

        .preview-nav-item.active {
            background: var(--primary);
        }

        .preview-content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .preview-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-md);
            padding: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .preview-card.large {
            grid-column: span 2;
            height: 120px;
        }

        /* Features Section */
        .section {
            padding: 100px 0;
        }

        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 4rem;
        }

        .section-label {
            color: var(--primary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-description {
            color: var(--gray-light);
            font-size: 1.125rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: rgba(30, 41, 59, 0.6);
            border-radius: var(--radius-lg);
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(37, 99, 235, 0.3);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--light);
        }

        .feature-description {
            color: var(--gray-light);
            line-height: 1.6;
        }

        /* CTA Section */
        .cta {
            background: var(--gradient-primary);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        }

        .cta-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
        }

        .cta-description {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
        }

        .btn-light {
            background: white;
            color: var(--primary);
        }

        .btn-light:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: var(--dark-2);
            padding: 60px 0 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand {
            max-width: 300px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .footer-description {
            color: var(--gray);
            line-height: 1.6;
        }

        .footer-heading {
            color: var(--light);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.125rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-link {
            margin-bottom: 0.5rem;
        }

        .footer-link a {
            color: var(--gray);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link a:hover {
            color: var(--light);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--gray);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .hero-title {
                font-size: 3rem;
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-actions {
                justify-content: center;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .btn {
                padding: 14px 24px;
                font-size: 0.875rem;
            }

            .hero-stats {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <span>EduManage Pro</span>
                </div>
                
                <div class="nav-links">
                    <a href="#features" class="nav-link">Features</a>
                    <a href="#solutions" class="nav-link">Solutions</a>
                    <a href="#pricing" class="nav-link">Pricing</a>
                    <a href="#about" class="nav-link">About</a>
                </div>
                
                <div class="nav-actions">
                    <a href="{{ route('login') }}" class="btn btn-secondary" style="padding: 10px 20px; font-size: 0.875rem;">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 10px 20px; font-size: 0.875rem;">
                        Get Started
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-grid">
                    <div class="hero-text">
                        <div class="badge animate-fade-in-up">
                            <i class="fas fa-rocket"></i>
                            Enterprise Ready Platform
                        </div>
                        <h1 class="hero-title animate-fade-in-up delay-100">
                            Transform Education with Intelligent Management
                        </h1>
                        <p class="hero-description animate-fade-in-up delay-200">
                            Streamline operations, enhance learning experiences, and drive academic excellence with our comprehensive, AI-powered student management platform designed for modern educational institutions.
                        </p>
                        <div class="hero-actions animate-fade-in-up delay-300">
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="fas fa-play-circle"></i>
                                Start Free Trial
                            </a>
                            <a href="#features" class="btn btn-secondary">
                                <i class="fas fa-chart-line"></i>
                                View Demo
                            </a>
                        </div>
                        <div class="hero-stats">
                            <div class="stat">
                                <div class="stat-number" data-count="500">0</div>
                                <div class="stat-label">Institutions</div>
                            </div>
                            <div class="stat">
                                <div class="stat-number" data-count="50000">0</div>
                                <div class="stat-label">Students</div>
                            </div>
                            <div class="stat">
                                <div class="stat-number" data-count="999">99.9%</div>
                                <div class="stat-label">Uptime</div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-visual">
                        <div class="dashboard-preview">
                            <div class="preview-header">
                                <div class="preview-nav">
                                    <div class="preview-nav-item active"></div>
                                    <div class="preview-nav-item"></div>
                                    <div class="preview-nav-item"></div>
                                </div>
                            </div>
                            <div class="preview-content">
                                <div class="preview-card"></div>
                                <div class="preview-card"></div>
                                <div class="preview-card large"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section" id="features">
        <div class="container">
            <div class="section-header">
                <div class="section-label">Platform Features</div>
                <h2 class="section-title">Everything You Need to Succeed</h2>
                <p class="section-description">
                    Comprehensive tools designed to streamline educational management and enhance learning outcomes
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="feature-title">Student Analytics</h3>
                    <p class="feature-description">
                        Advanced analytics and predictive insights for student performance, attendance patterns, and engagement metrics with AI-powered recommendations.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="feature-title">Smart Scheduling</h3>
                    <p class="feature-description">
                        AI-powered scheduling system for optimal resource allocation, conflict-free timetables, and automated room assignments.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="feature-title">Financial Suite</h3>
                    <p class="feature-description">
                        Comprehensive fee management with automated billing, digital receipts, financial reporting, and integrated payment gateways.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-network"></i>
                    </div>
                    <h3 class="feature-title">Parent Portal</h3>
                    <p class="feature-description">
                        Real-time communication platform connecting parents with teachers, instant notifications, and comprehensive student progress tracking.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Enterprise Security</h3>
                    <p class="feature-description">
                        Bank-grade security with role-based access control, data encryption, compliance management, and audit trails for complete data protection.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">Mobile Experience</h3>
                    <p class="feature-description">
                        Native mobile applications for iOS and Android with offline capabilities, push notifications, and seamless cross-platform synchronization.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Transform Your Institution?</h2>
                <p class="cta-description">
                    Join thousands of educational institutions already using EduManage Pro to streamline their operations and enhance student success.
                </p>
                <a href="{{ route('register') }}" class="btn btn-light">
                    <i class="fas fa-calendar-check"></i>
                    Schedule a Demo
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <i class="fas fa-graduation-cap"></i>
                        EduManage Pro
                    </div>
                    <p class="footer-description">
                        The leading student management platform for modern educational institutions, trusted by schools worldwide.
                    </p>
                </div>
                <div>
                    <h4 class="footer-heading">Product</h4>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#features">Features</a></li>
                        <li class="footer-link"><a href="#solutions">Solutions</a></li>
                        <li class="footer-link"><a href="#pricing">Pricing</a></li>
                        <li class="footer-link"><a href="#demo">Demo</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-heading">Resources</h4>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#blog">Blog</a></li>
                        <li class="footer-link"><a href="#docs">Documentation</a></li>
                        <li class="footer-link"><a href="#support">Support</a></li>
                        <li class="footer-link"><a href="#api">API</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-heading">Company</h4>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#about">About</a></li>
                        <li class="footer-link"><a href="#careers">Careers</a></li>
                        <li class="footer-link"><a href="#contact">Contact</a></li>
                        <li class="footer-link"><a href="#privacy">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 EduManage Pro. All rights reserved. Transforming Education Through Technology.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animated counter for statistics
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target === 999 ? '99.9%' : target + '+';
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current) + (target === 999 ? '%' : '+');
                }
            }, 16);
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('stat-number')) {
                        animateCounter(entry.target);
                    }
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        // Observe elements
        document.addEventListener('DOMContentLoaded', () => {
            // Observe stats
            document.querySelectorAll('.stat-number').forEach(stat => {
                observer.observe(stat);
            });

            // Observe feature cards
            document.querySelectorAll('.feature-card').forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                observer.observe(card);
            });

            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(15, 23, 42, 0.98)';
            } else {
                header.style.background = 'rgba(15, 23, 42, 0.95)';
            }
        });
    </script>
</body>
</html>