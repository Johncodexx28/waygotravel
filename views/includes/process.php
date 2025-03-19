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
    
    // Using prepared statement for registration
    $stmt = $conn->prepare("INSERT INTO users 
        (user_id, full_name, email, password, phone_number, address, city, state, zip_code) 
        VALUES 
        (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssssssss", $fullName, $signupEmail, $signupPassword, $phoneNumber, $address, $city, $state, $zipCode);
    
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
        ?>
        <script>
            alert("Login Successful");
            window.location.href = "../allproducts.php";
        </script>
        <?php
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
?>