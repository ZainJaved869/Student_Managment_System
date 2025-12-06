<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .splash-container {
            text-align: center;
            color: white;
            padding: 40px;
        }

        .logo {
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 5rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .logo h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .logo p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 40px;
        }

        .btn-group {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: #667eea;
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-outline:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 60px;
            max-width: 1000px;
        }

        .feature {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .feature h3 {
            margin-bottom: 10px;
            font-size: 1.3rem;
        }

        .feature p {
            opacity: 0.8;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .logo h1 {
                font-size: 2rem;
            }
            
            .btn-group {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="splash-container">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <h1>Student Management System</h1>
            <p>Streamline your educational institution's management</p>
            
            <div class="btn-group">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline">
                    <i class="fas fa-user-plus"></i> Create Account
                </a>
            </div>
        </div>

        <div class="features">
            <div class="feature">
                <i class="fas fa-users"></i>
                <h3>Student Management</h3>
                <p>Efficiently manage student records, attendance, and academic progress</p>
            </div>
            
            <div class="feature">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3>Staff Management</h3>
                <p>Organize teaching staff, schedules, and performance tracking</p>
            </div>
            
            <div class="feature">
                <i class="fas fa-money-bill-wave"></i>
                <h3>Fee Management</h3>
                <p>Streamline fee collection, tracking, and financial reporting</p>
            </div>
            
            <div class="feature">
                <i class="fas fa-chart-line"></i>
                <h3>Analytics & Reports</h3>
                <p>Generate comprehensive reports and insights for better decision making</p>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
</body>
</html>