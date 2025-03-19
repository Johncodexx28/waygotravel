<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-control {
            border-radius: 6px;
        }
        .toggle-password {
            cursor: pointer;
        }
        .btn-login {
            width: 100%;
            border-radius: 6px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h3 class="text-center mb-4">Admin Login</h3>
        <form id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Enter your username..." required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="password" class="form-control" placeholder="Enter your password..." required>
                    <span class="input-group-text toggle-password">
                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                    </span>
                </div>
            </div>
            <p class="text-danger text-center" id="error-message"></p>
            <button type="button" class="btn btn-primary btn-login" onclick="validateLogin()">Login</button>
        </form>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show/Hide Password
        document.getElementById('togglePassword').addEventListener('click', function () {
            var passwordField = document.getElementById('password');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.classList.replace("bi-eye-slash", "bi-eye");
            } else {
                passwordField.type = "password";
                this.classList.replace("bi-eye", "bi-eye-slash");
            }
        });

        // Login Validation
        function validateLogin() {
            var username = document.getElementById('username').value.trim();
            var password = document.getElementById('password').value.trim();
            var errorMessage = document.getElementById('error-message'); 
            
            errorMessage.textContent = "";
            
            if (username === "admin" && password === "admin123") {
                alert("Login successful!");
                window.location.href = "dashboard.html";
            } else {
                errorMessage.textContent = "Invalid username or password!";
            }
        }
    </script>

</body>
</html>
