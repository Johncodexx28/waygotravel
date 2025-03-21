<?php
include '../views/includes/conn.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Waygo Travel</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color:rgb(205, 205, 205);
        }
        .main-container {
            width: 800px;
            display: flex;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .image-side {
            width: 50%;
            background-image: url('../assets/img/admin_img_log.png');
            background-size: cover;
            background-position: center;
            position: relative;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
      
        .login-side {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        .login-container {
            width: 100%;
        }
        .form-control {
            border-radius: 6px;
            padding: 10px 15px;
            margin-bottom: 15px;
        }
        .btn-login {
            width: 100%;
            border-radius: 6px;
            font-weight: 500;
            background-color: #ce1212;
            border-color: #ce1212;
            padding: 10px;
        }
        .btn-login:hover {
            background-color:rgb(190, 64, 64);
            border-color: rgb(190, 64, 64);
        }
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            background-image: url(../assets/img/chefs/chefs-2.jpg);
            border: 2px solid #ccc;
            margin-right: 10px;
            display: flex;
            overflow: hidden;
        }
        .logo-segment {
            width: 50%;
            height: 100%;
        }
        .logo-left {
            background-color: #ccc;
        }
        .logo-right {
            background-color: #ce1212;
        }
        .logo-text {
            color: #333;
        }
        .logo-text span {
            color: #ce1212;
        }
        @media (max-width: 768px) {
            .main-container {
                width: 90%;
                flex-direction: column;
            }
            .image-side, .login-side {
                width: 100%;
            }
            .image-side {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Left side with background image -->
        <div class="image-side">
        </div>
        
        <!-- Right side with login form -->
        <div class="login-side">
            <div class="login-container">
                <!-- Logo -->
                <div class="logo">
                    <div class="logo-circle">
                    </div>
                    <div class="logo-text">
                        <strong>Waygo <span>Travel</span></strong>
                        <div style="font-size: 0.8rem;">Welcome Back Admin</div>
                    </div>
                </div>
                
                <p class="mb-3">Login Here</p>
                
                <form action="../admin/adminauth.php" method="POST">
                    <div class="mb-3">
                        <input type="text" id="accname" name="accname" class="form-control" placeholder="admin" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="#" class="text-decoration-none text-muted">Forgot Password?</a>
                    </div>
                    <button type="submit" id="login" name="login" class="btn btn-danger btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/Hide Password functionality
        document.addEventListener('DOMContentLoaded', function() {
            // You can add a password toggle feature here if needed
        });
    </script>
</body>
</html>