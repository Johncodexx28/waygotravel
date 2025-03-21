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

   
    
        
    // Process form submission
    if(isset($_POST['add_product'])) {
        // Collect form data
        $productName = mysqli_real_escape_string($conn, $_POST['productName']);
        $productCategory = mysqli_real_escape_string($conn, $_POST['productCategory']);
        $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
        $productDescription = mysqli_real_escape_string($conn, $_POST['productDescription']);
        $imagePath = null;
        
        // Image upload handling
        $target_dir = __DIR__ . "/../../assets/img/uploads/";
        
        // Make sure the directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if($check !== false) {
            // File is an image
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            // Create a unique filename instead
            $target_file = $target_dir . time() . '_' . basename($_FILES["productImage"]["name"]);
        }
        
        // Check file size
        if ($_FILES["productImage"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars(basename($_FILES["productImage"]["name"])). " has been uploaded.";
                
                // Set image path to be stored in database (relative path)
                $imagePath = "assets/img/uploads/" . basename($_FILES["productImage"]["name"]);
                
                // Insert product into database
                $sql = "INSERT INTO products (name, category_id, price, description, image) 
                        VALUES ('$productName', '$productCategory', '$productPrice', '$productDescription', '$imagePath')";
                        
                if ($conn->query($sql)) {
                    // Redirect with success message
                    $_SESSION['message'] = "Product added successfully!";
                    header("Location: ../../admin/productslist.php");
                    exit;
                } else {
                    echo "Failed to add product: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }




        if(isset($_POST['edit_product'])){  
          
            $product_id = $_POST['update_id'];
            
         
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            
        
            $query = "UPDATE products SET 
                      name='$name', 
                      description='$description', 
                      price='$price'";
            
         
            if(isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                $target_dir = __DIR__ . "/../../assets/img/uploads/";
                
                
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $target_file = $target_dir . time() . '_' . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
             
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false && 
                   in_array($imageFileType, ["jpg", "jpeg", "png", "gif", "webp"]) && 
                   $_FILES["image"]["size"] <= 500000) {
                    
                    
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // Add image path to the update query
                        $imagePath = "assets/img/uploads/" . basename($target_file);
                        $query .= ", image='$imagePath'";
                    }
                }
            }
          
            $query .= " WHERE id='$product_id'";
            
          
            $update_product = mysqli_query($conn, $query);
            
            if($update_product) {
                ?>    
                <script>
                    alert("Product Updated Successfully!");
                    window.location.href="../admin/productslist.php";
                </script>
                <?php
            } else {
                ?>    
                <script>
                    alert("Error occurred during update: <?php echo mysqli_error($conn); ?>");
                    window.location.href="../admin/productslist.php";
                </script>
                <?php
            }  
        }

    }

    ?>
   

   