<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage Pro - Complete Student Management System</title>
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
            --secondary: #059669;
            --accent: #d97706;
            --dark: #0f172a;
            --dark-2: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #cbd5e1;
            --gradient-primary: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            --gradient-secondary: linear-gradient(135deg, #059669 0%, #047857 100%);
            --gradient-accent: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--dark);
            color: var(--light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
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

        .nav-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
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

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: var(--gradient-primary);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 120px 20px 80px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 20px;
            border-radius: 100px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: white;
        }

        .hero-description {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-light {
            background: white;
            color: var(--primary);
        }

        .btn-light:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
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
            color: var(--light);
        }

        .section-description {
            color: var(--gray-light);
            font-size: 1.125rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--dark-2);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
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
            height: 4px;
            background: var(--gradient-primary);
        }

        .feature-card:nth-child(2)::before {
            background: var(--gradient-secondary);
        }

        .feature-card:nth-child(3)::before {
            background: var(--gradient-accent);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(37, 99, 235, 0.3);
            box-shadow: var(--shadow-xl);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
        }

        .feature-card:nth-child(2) .feature-icon {
            background: var(--gradient-secondary);
        }

        .feature-card:nth-child(3) .feature-icon {
            background: var(--gradient-accent);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--light);
        }

        .feature-description {
            color: var(--gray-light);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .feature-list {
            list-style: none;
            margin-top: 1rem;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.5rem;
            color: var(--gray-light);
        }

        .feature-list li i {
            color: var(--secondary);
            font-size: 0.875rem;
        }

        /* Modules Section */
        .modules {
            background: var(--dark-2);
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .module-card {
            background: var(--dark);
            border-radius: var(--radius-lg);
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }

        .module-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: var(--shadow-lg);
        }

        .module-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem;
        }

        .module-card:nth-child(2) .module-icon {
            background: var(--gradient-secondary);
        }

        .module-card:nth-child(3) .module-icon {
            background: var(--gradient-accent);
        }

        .module-card:nth-child(4) .module-icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }

        .module-card:nth-child(5) .module-icon {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        }

        .module-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--light);
        }

        .module-description {
            color: var(--gray);
            font-size: 0.875rem;
            line-height: 1.5;
        }

        /* CTA Section */
        .cta {
            background: var(--gradient-secondary);
            padding: 80px 0;
            text-align: center;
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
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            padding: 60px 0 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .footer-content {
            margin-bottom: 2rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 1rem;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .footer-description {
            color: var(--gray);
            max-width: 400px;
            margin: 0 auto 2rem;
        }

        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--gray);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 200px;
                justify-content: center;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .modules-grid {
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

            .feature-card {
                padding: 2rem 1.5rem;
            }

            .module-card {
                padding: 1.5rem;
            }
        }
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
                <div class="nav-actions">
                    <a href="{{ route('login') }}" class="btn btn-secondary">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fas fa-rocket"></i>
                    Complete Student Management Solution
                </div>
                <h1 class="hero-title">
                    Streamline Your Educational Institution
                </h1>
                <p class="hero-description">
                    Manage students, staff, fees, leaves, and permissions in one integrated platform. 
                    Designed for schools and educational institutions to simplify administration and enhance productivity.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn btn-light">
                        <i class="fas fa-play-circle"></i>
                        Start Free Trial
                    </a>
                    <a href="#features" class="btn btn-secondary">
                        <i class="fas fa-eye"></i>
                        View Features
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section" id="features">
        <div class="container">
            <div class="section-header">
                <div class="section-label">Core Features</div>
                <h2 class="section-title">Everything You Need to Manage Your Institution</h2>
                <p class="section-description">
                    Comprehensive tools designed specifically for educational management
                </p>
            </div>
            <div class="features-grid">
                <!-- Student Management -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="feature-title">Student Management</h3>
                    <p class="feature-description">
                        Complete student lifecycle management from admission to graduation with advanced tracking and reporting.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Add, edit, and delete student records</li>
                        <li><i class="fas fa-check"></i> Class and section management</li>
                        <li><i class="fas fa-check"></i> Attendance tracking</li>
                        <li><i class="fas fa-check"></i> Academic performance monitoring</li>
                        <li><i class="fas fa-check"></i> Parent information management</li>
                    </ul>
                </div>

                <!-- Staff Management -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="feature-title">Staff Management</h3>
                    <p class="feature-description">
                        Efficiently manage teaching and non-teaching staff with comprehensive profile management.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Staff record management</li>
                        <li><i class="fas fa-check"></i> Department and position tracking</li>
                        <li><i class="fas fa-check"></i> Salary and payroll information</li>
                        <li><i class="fas fa-check"></i> Qualification and certification tracking</li>
                        <li><i class="fas fa-check"></i> Performance evaluation system</li>
                    </ul>
                </div>

                <!-- Financial Management -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="feature-title">Fees & Financial Management</h3>
                    <p class="feature-description">
                        Streamline fee collection, financial tracking, and payment management with automated systems.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Fee structure management</li>
                        <li><i class="fas fa-check"></i> Payment tracking and receipts</li>
                        <li><i class="fas fa-check"></i> Late fee calculations</li>
                        <li><i class="fas fa-check"></i> Financial reports and analytics</li>
                        <li><i class="fas fa-check"></i> Scholarship and discount management</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Modules Section -->
    <section class="section modules">
        <div class="container">
            <div class="section-header">
                <div class="section-label">All Modules</div>
                <h2 class="section-title">Complete Management Suite</h2>
                <p class="section-description">
                    Integrated modules that work together seamlessly
                </p>
            </div>
            <div class="modules-grid">
                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="module-title">Student Management</h4>
                    <p class="module-description">
                        Comprehensive student records, attendance, and academic tracking
                    </p>
                </div>

                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="module-title">Staff Management</h4>
                    <p class="module-description">
                        Teaching and administrative staff management with payroll
                    </p>
                </div>

                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h4 class="module-title">Fees Management</h4>
                    <p class="module-description">
                        Fee collection, tracking, and financial reporting
                    </p>
                </div>

                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h4 class="module-title">Leave Management</h4>
                    <p class="module-description">
                        Staff and student leave applications and approvals
                    </p>
                </div>

                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h4 class="module-title">Roles & Permissions</h4>
                    <p class="module-description">
                        Secure access control and user role management
                    </p>
                </div>

                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h4 class="module-title">System Settings</h4>
                    <p class="module-description">
                        Institution configuration and system preferences
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Features Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-label">Advanced Features</div>
                <h2 class="section-title">Built for Modern Education</h2>
                <p class="section-description">
                    Additional capabilities that enhance your management experience
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Leave Management System</h3>
                    <p class="feature-description">
                        Streamlined leave application and approval process for both staff and students.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Online leave applications</li>
                        <li><i class="fas fa-check"></i> Approval workflow management</li>
                        <li><i class="fas fa-check"></i> Leave balance tracking</li>
                        <li><i class="fas fa-check"></i> Automatic notifications</li>
                        <li><i class="fas fa-check"></i> Leave history and reports</li>
                    </ul>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Roles & Permissions</h3>
                    <p class="feature-description">
                        Secure role-based access control to protect sensitive information and manage user privileges.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Custom user roles</li>
                        <li><i class="fas fa-check"></i> Granular permission controls</li>
                        <li><i class="fas fa-check"></i> Audit trail and activity logs</li>
                        <li><i class="fas fa-check"></i> Data access restrictions</li>
                        <li><i class="fas fa-check"></i> Multi-level administration</li>
                    </ul>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <h3 class="feature-title">System Settings & Configuration</h3>
                    <p class="feature-description">
                        Flexible system configuration to match your institution's specific requirements and policies.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Institution profile setup</li>
                        <li><i class="fas fa-check"></i> Academic year configuration</li>
                        <li><i class="fas fa-check"></i> Custom field management</li>
                        <li><i class="fas fa-check"></i> System preferences</li>
                        <li><i class="fas fa-check"></i> Backup and data management</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Simplify Your Institution Management?</h2>
                <p class="cta-description">
                    Join educational institutions that have transformed their administration with EduManage Pro. 
                    Get started today and experience the difference.
                </p>
                <a href="{{ route('register') }}" class="btn btn-light">
                    <i class="fas fa-calendar-check"></i>
                    Start Your Free Trial
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fas fa-graduation-cap"></i>
                    EduManage Pro
                </div>
                <p class="footer-description">
                    The complete student management system for modern educational institutions. 
                    Streamline operations, enhance productivity, and focus on education.
                </p>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 EduManage Pro. All rights reserved. Transforming Educational Management.</p>
            </div>
        </div>
    </footer>

    <script>
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

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(15, 23, 42, 0.98)';
            } else {
                header.style.background = 'rgba(15, 23, 42, 0.95)';
            }
        });

        // Add animation to feature cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.addEventListener('DOMContentLoaded', () => {
            const featureCards = document.querySelectorAll('.feature-card, .module-card');
            featureCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>