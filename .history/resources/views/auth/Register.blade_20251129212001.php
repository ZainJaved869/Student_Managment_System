<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EduManage Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --dark: #0f172a;
            --dark-2: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #cbd5e1;
            --gradient-primary: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            --gradient-secondary: linear-gradient(135deg, #059669 0%, #047857 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--gradient-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--light);
        }

        .register-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 1000px;
            width: 100%;
            background: var(--dark-2);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .register-left {
            background: var(--gradient-secondary);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
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

        .register-content {
            position: relative;
            z-index: 2;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .logo-text {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: white;
        }

        .welcome-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .benefits-list {
            list-style: none;
            text-align: left;
            max-width: 300px;
            margin: 0 auto;
        }

        .benefits-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }

        .benefits-list li i {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.8rem;
        }

        .register-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-header {
            margin-bottom: 30px;
        }

        .register-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--light);
        }

        .register-subtitle {
            color: var(--gray);
            font-size: 1rem;
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
            padding: 14px 16px;
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

        .password-requirements {
            margin-top: 8px;
            font-size: 0.8rem;
            color: var(--gray);
        }

        .password-requirements ul {
            list-style: none;
            margin-top: 5px;
        }

        .password-requirements li {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 3px;
        }

        .password-requirements li i {
            font-size: 0.7rem;
        }

        .requirement-met {
            color: var(--secondary);
        }

        .requirement-unmet {
            color: var(--gray);
        }

        .btn {
            padding: 14px 20px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .form-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-footer p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .form-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
            color: #fca5a5;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle-icon:hover {
            color: var(--gray-light);
        }

        .terms-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 25px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-md);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .terms-group input {
            margin-top: 3px;
            accent-color: var(--primary);
        }

        .terms-group label {
            color: var(--gray-light);
            font-size: 0.85rem;
            line-height: 1.4;
            cursor: pointer;
        }

        .terms-group a {
            color: var(--primary);
            text-decoration: none;
        }

        .terms-group a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-container {
                grid-template-columns: 1fr;
                max-width: 450px;
            }

            .register-left {
                padding: 40px 30px;
                display: none; /* Hide left panel on mobile */
            }

            .register-right {
                padding: 40px 30px;
            }
        }

        @media (max-width: 480px) {
            .register-right {
                padding: 30px 20px;
            }

            .register-title {
                font-size: 1.5rem;
            }

            .welcome-title {
                font-size: 1.75rem;
            }
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
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Left Panel - Benefits & Features -->
        <div class="register-left">
            <div class="register-content">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="logo-text">EduManage Pro</div>
                </div>
                <h2 class="welcome-title">Join EduManage Pro</h2>
                <p class="welcome-description">
                    Create your account and start transforming your educational institution management today.
                </p>
                <ul class="benefits-list">
                    <li><i class="fas fa-check"></i> Complete Student Management</li>
                    <li><i class="fas fa-check"></i> Staff & Faculty Profiles</li>
                    <li><i class="fas fa-check"></i> Automated Fee Tracking</li>
                    <li><i class="fas fa-check"></i> Leave Management System</li>
                    <li><i class="fas fa-check"></i> Secure Role-based Access</li>
                    <li><i class="fas fa-check"></i> Real-time Analytics & Reports</li>
                </ul>
            </div>
        </div>

        <!-- Right Panel - Registration Form -->
        <div class="register-right">
            <div class="register-header">
                <h1 class="register-title">Create Account</h1>
                <p class="register-subtitle">Join thousands of educational institutions using EduManage Pro</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger animate-fade-in-up">
                    @foreach($errors->all() as $error)
                        <p><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="animate-fade-in-up" id="registerForm">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Enter your email address">
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="password-toggle">
                        <input type="password" name="password" class="form-control" required placeholder="Create a password" id="password" oninput="checkPassword()">
                        <span class="password-toggle-icon" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="toggleIcon1"></i>
                        </span>
                    </div>
                    <div class="password-requirements">
                        <div>Password must contain:</div>
                        <ul>
                            <li id="req-length"><i class="fas fa-circle"></i> At least 8 characters</li>
                            <li id="req-uppercase"><i class="fas fa-circle"></i> One uppercase letter</li>
                            <li id="req-lowercase"><i class="fas fa-circle"></i> One lowercase letter</li>
                            <li id="req-number"><i class="fas fa-circle"></i> One number</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <div class="password-toggle">
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm your password" id="confirmPassword" oninput="checkPasswordMatch()">
                        <span class="password-toggle-icon" onclick="togglePassword('confirmPassword')">
                            <i class="fas fa-eye" id="toggleIcon2"></i>
                        </span>
                    </div>
                    <div id="password-match" class="password-requirements" style="display: none;">
                        <span id="match-text"></span>
                    </div>
                </div>

                <div class="terms-group">
                    <input type="checkbox" name="terms" id="terms" required>
                    <label for="terms">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. 
                        I understand that my data will be processed in accordance with EduManage Pro's data protection policies.
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>
            </form>

            <div class="form-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId === 'password' ? 'toggleIcon1' : 'toggleIcon2');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function checkPassword() {
            const password = document.getElementById('password').value;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password)
            };

            // Update requirement indicators
            document.getElementById('req-length').className = requirements.length ? 'requirement-met' : 'requirement-unmet';
            document.getElementById('req-uppercase').className = requirements.uppercase ? 'requirement-met' : 'requirement-unmet';
            document.getElementById('req-lowercase').className = requirements.lowercase ? 'requirement-met' : 'requirement-unmet';
            document.getElementById('req-number').className = requirements.number ? 'requirement-met' : 'requirement-unmet';

            // Update icons
            document.querySelectorAll('#req-length i, #req-uppercase i, #req-lowercase i, #req-number i').forEach(icon => {
                if (icon.parentElement.className === 'requirement-met') {
                    icon.className = 'fas fa-check-circle';
                } else {
                    icon.className = 'fas fa-circle';
                }
            });

            checkPasswordMatch();
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const matchDiv = document.getElementById('password-match');
            const matchText = document.getElementById('match-text');

            if (confirmPassword.length > 0) {
                matchDiv.style.display = 'block';
                if (password === confirmPassword) {
                    matchText.innerHTML = '<i class="fas fa-check-circle requirement-met"></i> Passwords match';
                    matchText.className = 'requirement-met';
                } else {
                    matchText.innerHTML = '<i class="fas fa-times-circle"></i> Passwords do not match';
                    matchText.className = 'requirement-unmet';
                }
            } else {
                matchDiv.style.display = 'none';
            }
        }

        // Add loading state to form submission
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
            submitBtn.disabled = true;
        });

        // Real-time validation
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.style.borderColor = 'rgba(220, 38, 38, 0.5)';
                    } else {
                        this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                    }
                });

                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--primary)';
                });
            });
        });
    </script>
</body>
</html>