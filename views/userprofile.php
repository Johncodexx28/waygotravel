<?php
    session_start();
    include '../views/includes/conn.php';
    $pageTitle = "My Profile - WayGo Travel";

    
    include '../views/includes/conn.php';
    include '../cart/getcartcount.php';
    
    if (!isset($_SESSION['email'])) {
        header("Location: ../index.php");
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $get_userdata = mysqli_query($conn, "SELECT * FROM users WHERE user_id= '$user_id' ");
    $user = mysqli_fetch_assoc($get_userdata);
    
    $success_message = "";
    $error_message = "";
    
    // Process form submission for profile update
    if(isset($_POST['update_profile'])) {
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        
        // Check if email is already used by another account
        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_id != '$user_id'");
        if(mysqli_num_rows($check_email) > 0) {
            $error_message = "Email is already in use by another account.";
        } else {
            // Update profile
            $update_query = mysqli_query($conn, "UPDATE users SET full_name='$fullname', email='$email', address='$address' WHERE user_id='$user_id'");
            
            if($update_query) {
                $_SESSION['email'] = $email; // Update session email
                $_SESSION['message']= "Profile updated successfully!";
                $_SESSION['type'] = "success";
                // Refresh user data
                $get_userdata = mysqli_query($conn, "SELECT * FROM users WHERE user_id= '$user_id' ");
                $user = mysqli_fetch_assoc($get_userdata);
            } else {
                $_SESSION['message']= "Failed to update profile. Please Try Again.";
                $_SESSION['type'] = "error";
            }
        } 
    }
    
    // Process password change
    if(isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Verify current password
        $check_pass = mysqli_query($conn, "SELECT password FROM users WHERE user_id='$user_id'");
        $pass_data = mysqli_fetch_assoc($check_pass);
        
        // Check if the current password is already hashed
        if(password_verify($current_password, $pass_data['password'])) {
            // Password is already hashed and matches
            if($new_password == $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_pass = mysqli_query($conn, "UPDATE users SET password='$hashed_password' WHERE user_id='$user_id'");
                
                if($update_pass) {
                    $_SESSION['message']= "Profile updated successfully!";
                    $_SESSION['type'] = "success";
                } else {
                    $_SESSION['message'] = "Failed to update password. Please try again.";
                    $_SESSION['type'] = "error";
                }
            } else {
                $_SESSION['message'] = "New passwords do not match.";
                $_SESSION['type'] = "error";
            }
        } else if($current_password == $pass_data['password']) {
            // Password is not hashed (stored in plain text)
            if($new_password == $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_pass = mysqli_query($conn, "UPDATE users SET password='$hashed_password' WHERE user_id='$user_id'");
                
                if($update_pass) {
                    $_SESSION['message'] = "Password changed successfully! Your password is now securely stored.";
                    $_SESSION['type'] = "success";
                } else {
                    $_SESSION['message']= "Failed to update password. Please try again.";
                    $_SESSION['type'] = "error";
                }
            } else {
                $_SESSION['message']= "New passwords do not match.";
                $_SESSION['type'] = "error";
            }
        } else {
            $_SESSION['message']= "Current password is incorrect.";
            $_SESSION['type'] = "error";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include '../views/includes/head.php' ?>
    
    <style>
   
        .profile-page-styles {
            /* General styles */
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --border-radius: 6px;
            --box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
            --transition: all 0.3s ease;
        }

        /* Profile container styles */
        .profile-container {
            margin-top: 2rem;
            margin-bottom: 3rem;
        }

        /* Card styling */
        .profile-card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .profile-card .card-header {
            padding: 1.2rem 1.5rem;
            background-color: var(--primary-color);
            border-bottom: none;
        }

        .profile-card .card-body {
            padding: 2rem;
        }

        /* Profile image section */
        .profile-image-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .profile-image:hover {
            transform: scale(1.03);
        }

        .profile-name {
            margin-bottom: 1rem;
            font-weight: 600;
        }

        #uploadPhotoBtn {
            padding: 0.375rem 1rem;
            border-radius: 50px;
            transition: var(--transition);
        }

        #uploadPhotoBtn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Tab navigation */
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 1.5rem;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #495057;
            padding: 0.75rem 1rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .nav-tabs .nav-link:hover {
            color: var(--primary-color);
            border-color: transparent;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            background-color: transparent;
            border-bottom: 2px solid var(--primary-color);
        }

        /* Form styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            height: calc(2.25rem + 2px);
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            border: 1px solid #ced4da;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        textarea.form-control {
            height: auto;
            min-height: 100px;
        }

        .col-form-label {
            font-weight: 500;
            padding-top: calc(0.75rem + 1px);
        }

        /* Button styling */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: #3a5ccc;
            border-color: #3a5ccc;
            transform: translateY(-2px);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .profile-image-container {
                margin-bottom: 2rem;
            }
            
            .col-form-label {
                margin-bottom: 0.5rem;
            }
            
            .offset-md-3 {
                margin-left: 0;
            }
        }
    </style>

<body class="profile-page-styles">
    <?php include '../views/includes/navbar.php' ?>
    <?php include "../assets/components/sweetalert.php"; ?>
    
    <main class="main">
        <div class="container profile-container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card shadow profile-card">
                        <div class="card-header bg-dark text-white">
                            <h2 class="mb-0 fw-bolder text-center text-light">My Profile</h2>
                        </div>
                        <div class="card-body">
                           
                            
                            <div class="row">
                          
                                <!-- Right Side - Settings Tabs -->
                                <div class="col-md-12">
                                    <!-- Profile Information Tab -->
                                    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile Information</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">Change Password</button>
                                        </li>
                                    </ul>
                                                                    
                                    <div class="tab-content mt-3" id="profileTabsContent">
                                        <!-- Profile Information Form -->
                                        <div class="tab-pane fade show active" id="profile" role="tabpanel"  aria-labelledby="profile-tab">
                                            <form method="POST" action="" >
                                                <div class="form-group row">
                                                    <label for="fullname" class="col-md-3 col-form-label">Full Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['full_name']; ?>" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="email" class="col-md-3 col-form-label">Email Address</label>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="address" class="col-md-3 col-form-label">Address</label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control" id="address" name="address" rows="3" style="resize: noney;"><?php echo $user['address']; ?></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <div class="col-md-9 offset-md-3">
                                                        <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <!-- Change Password Form -->
                                        <div class="tab-pane fade" id="password" role="tabpanel">
                                            <form method="POST" action="" >
                                                <div class="form-group row">
                                                    <label for="current_password" class="col-md-3 col-form-label">Current Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" id="current_password" name="current_password" value="<?php $user['password'] ?>" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="new_password" class="col-md-3 col-form-label">New Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="confirm_password" class="col-md-3 col-form-label">Confirm New Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <div class="col-md-9 offset-md-3">
                                                        <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../views/includes/footer.php' ?>

   
    
    <!-- Add custom JavaScript for photo upload functionality -->
    <script>
    document.getElementById('uploadPhotoBtn').addEventListener('click', function() {
        // This would normally open a file dialog and handle image upload
        // For now it's just a placeholder
        alert('Photo upload functionality would go here');
    });
    </script>
   
</body>
</html>