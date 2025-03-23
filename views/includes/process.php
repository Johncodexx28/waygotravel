<?php

session_start();
include "conn.php";


    // Process registration
    if(isset($_POST['createAccount'])){
        // Get form data
        $fullName = $_POST['fullName'];
        $signupEmail = $_POST['signupEmail'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipCode = $_POST['zipCode'];
        $signupPassword = $_POST['signupPassword'];
        
        // Hash the password
        $hashedPassword = password_hash($signupPassword, PASSWORD_DEFAULT);
        
        // First check if email already exists
        $check_stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $signupEmail);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if($result->num_rows > 0) {
            // Email already exists
            ?>
            <script>
                alert("This email is already registered. Please use a different email.");
                window.location.href="../../index.php";
            </script>
            <?php
            $check_stmt->close();
            exit;
        }
        $check_stmt->close();
        
        // Using prepared statement for registration
        $stmt = $conn->prepare("INSERT INTO users 
            (user_id, full_name, email, password, phone_number, address, city, state, zip_code) 
            VALUES 
            (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters - use hashedPassword instead of signupPassword
        $stmt->bind_param("ssssssss", $fullName, $signupEmail, $hashedPassword, $phoneNumber, $address, $city, $state, $zipCode);
        
        // Execute the query
        if($stmt->execute()){
            ?>
            <script>
                alert("Registered Successfully!");
                window.location.href="../../index.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Registration Error: <?php echo $stmt->error; ?>");
                window.location.href="../../index.php";
            </script>
            <?php
        }
        $stmt->close();
    }

    // Process login
    if(isset($_POST['login'])){
        $log_email = $_POST['loginEmail'];
        $log_password = $_POST['loginPassword'];
        
        // Using prepared statement for login - only check email first
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $log_email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows >= 1){
            // Get user data
            $user_data = $result->fetch_assoc();
            
            // Verify password hash
            if(password_verify($log_password, $user_data['password'])){
                // Password is correct
                $_SESSION['email'] = $log_email;
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['full_name'] = $user_data['full_name'];
            
                $_SESSION['message'] = "Login successfully!";
                $_SESSION['type'] = "success";
                ?>
                <script>
                    window.location.href = "../allproducts.php";
                </script>
                <?php
                exit;
            } else {
        
              $_SESSION['message'] = "Login failed.";
              $_SESSION['type'] = "success";
              ?>
              <script>
                  window.location.href = "../../index.php";
              </script>
              <?php
            }
        } else {
            // Email not found
            ?>
            <script>
                alert("Email or Password not found!");
                window.location.href = "../../index.php";
            </script>
            <?php
        }
        $stmt->close();
    }

    // Process login
    if(isset($_POST['login'])){
        $log_email = $_POST['loginEmail'];
        $log_password = $_POST['loginPassword'];
        
        // Using prepared statement for login
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $log_email, $log_password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows >= 1){
            $_SESSION['email'] = $log_email;
            // Get user data
            $user_data = $result->fetch_assoc();
            $_SESSION['user_id'] = $user_data['user_id'];
            $_SESSION['full_name'] = $user_data['full_name'];
           
            $_SESSION['message'] = "Login successfully!";
            $_SESSION['type'] = "success";
            ?>
            <script>
                window.location.href = "../allproducts.php";
            </script>

            <?php
            exit;
        } else {
            ?>
            <script>
                alert("Email or Password not found!");
                window.location.href = "../../index.php";
            </script>
            <?php
        }
        $stmt->close();
        
    }


 

   