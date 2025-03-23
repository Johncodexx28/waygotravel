<?php 
    include '../views/includes/conn.php';
    session_start();  
    
    
   

    // Process login
    if (isset($_POST['login'])) {
        $adminlog_name = $_POST['accname'];
        $adminlog_password = $_POST['password'];

        // Using prepared statement to fetch user data by account name
        $stmt = $conn->prepare("SELECT * FROM admins WHERE account_name = ?");
        $stmt->bind_param("s", $adminlog_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows >= 1) {
            $row = $result->fetch_assoc();
            
            // Direct comparison without password verification
            if ($adminlog_password === trim($row['password'])) {
                $_SESSION['account_name'] = $adminlog_name;
                ?>
                <script>
                    alert("Login Successful");
                    window.location.href = '../admin/dash.php';  // Redirect to a protected page
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Incorrect password! ");
                    window.location.href = '../admin/login.php';
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Account name not found! ");
                window.location.href = '../admin/login.php';
            </script>
            <?php
        }
        
        $stmt->close();
    }



  
    if(isset($_POST['add_product'])) {
   
        $productName = mysqli_real_escape_string($conn, $_POST['productName']);
        $productCategory = mysqli_real_escape_string($conn, $_POST['productCategory']);
        $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
        $productDescription = mysqli_real_escape_string($conn, $_POST['productDescription']);
        $imagePath = null;
        
       
        if(!isset($_FILES["productImage"]) || $_FILES["productImage"]["error"] != 0) {
            $_SESSION['message'] = "Please select an image to upload.";
            header("Location: ../admin/productslist.php");
            exit;
        }
        
       
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/WayGo-Travel-Website/assets/img/uploads/";
        error_log("Target directory: " . $target_dir);

        
       
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
      
        $unique_filename = time() . '_' . basename($_FILES["productImage"]["name"]);
        $target_file = $target_dir . $unique_filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if($check === false) {
            $_SESSION['message'] = "File is not an image.";
            $_SESSION['type'] = "success";
            header("Location: ../admin/productslist.php");
            exit;
        }
        
        
        if ($_FILES["productImage"]["size"] > 500000) {
            $_SESSION['message'] = "Sorry, your file is too large.";
            $_SESSION['type'] = "Danger";
            header("Location: ../admin/productslist.php");
            exit;
        }
        
      
        if(!in_array($imageFileType, ["jpg", "jpeg", "png", "gif", "webp"])) {
            $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
            $_SESSION['type'] = "Danger";
            header("Location: ../admin/productslist.php");
            exit;
        }
        
       
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
          
            $imagePath = "assets/img/uploads/" . $unique_filename;
            
          
            $sql = "INSERT INTO products (name, category_id, price, description, image) 
                    VALUES ('$productName', '$productCategory', '$productPrice', '$productDescription', '$imagePath')";
                    
            if ($conn->query($sql)) {
             
                $_SESSION['message'] = "Product added successfully!";
                $_SESSION['type'] = "success";
                header("Location: ../admin/productslist.php");
                exit;
            } else {
                $_SESSION['message'] = "Failed to add product: " . $conn->error;
                $_SESSION['type'] = "Danger";
                header("Location: ../admin/productslist.php");
                exit;
            }
        } else {
            $_SESSION['message'] = "Sorry, there was an error uploading your file.";
            $_SESSION['type'] = "Danger";
            header("Location: ../admin/productslist.php");
            exit;
        }
    }

    if (isset($_POST['edit_product'])) {  
        // Enable error logging to see what's happening
        error_log("Starting edit_product process");
        
        $product_id = intval($_POST['update_id']); 
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
    
        $query = "UPDATE products SET 
                  name='$name', 
                  description='$description', 
                  price='$price'";
    
        // Debug image upload info
        error_log("Image upload info: " . print_r($_FILES, true));
        
        // Check if a new image was uploaded
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            error_log("Processing image upload");
            
            // Define absolute target directory path
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/WayGo-Travel-Website/assets/img/uploads/";
            error_log("Target directory: " . $target_dir);
            
            // Make sure the directory exists with proper permissions
            if (!is_dir($target_dir)) {
                error_log("Directory doesn't exist, creating: " . $target_dir);
                if (!mkdir($target_dir, 0777, true)) {
                    error_log("Failed to create directory: " . $target_dir);
                    $_SESSION['message'] = "Failed to create upload directory.";
                    $_SESSION['type'] = "Danger";
                    header("Location: ../admin/productslist.php");
                    exit;
                }
            }
            
            // Test directory permissions
            if (!is_writable($target_dir)) {
                error_log("Directory not writable: " . $target_dir);
                $_SESSION['message'] = "Upload directory is not writable.";
                $_SESSION['type'] = "Danger";
                header("Location: ../admin/productslist.php");
                exit;
            }
    
            // Create a unique filename with timestamp
            $unique_filename = time() . '_' . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $unique_filename;
            error_log("Target file: " . $target_file);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check if image file is an actual image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check === false) {
                error_log("File is not an image");
                $_SESSION['message'] = "File is not an image.";
                $_SESSION['type'] = "Danger";
                header("Location: ../admin/productslist.php");
                exit;
            }
            
            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                error_log("File too large: " . $_FILES["image"]["size"]);
                $_SESSION['message'] = "Sorry, your file is too large.";
                $_SESSION['type'] = "Danger";
                header("Location: ../admin/productslist.php");
                exit;
            }
            
            // Allow certain file formats
            if(!in_array($imageFileType, ["jpg", "jpeg", "png", "gif", "webp"])) {
                error_log("Invalid file type: " . $imageFileType);
                $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
                $_SESSION['type'] = "Danger";
                header("Location: ../admin/productslist.php");
                exit;
            }
            
            // Get old image to delete it
            $old_image_query = mysqli_query($conn, "SELECT image FROM products WHERE product_id='$product_id'");
            $old_image_data = mysqli_fetch_assoc($old_image_query);
            $old_image_path = $_SERVER['DOCUMENT_ROOT'] . "/WayGo-Travel-Website/" . $old_image_data['image'];
            error_log("Old image path: " . $old_image_path);
            
            // Try to upload the new file
            error_log("Attempting to move uploaded file from: " . $_FILES["image"]["tmp_name"] . " to: " . $target_file);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                error_log("File uploaded successfully");
                
                // Update database with new image path (relative path)
                $imagePath = "assets/img/uploads/" . $unique_filename;
                $query .= ", image='$imagePath'";
                error_log("Database image path set to: " . $imagePath);

                // Delete old image if it exists
                if (file_exists($old_image_path) && !empty($old_image_data['image'])) {
                    unlink($old_image_path);
                    error_log("Deleted old image: " . $old_image_path);
                } else {
                    error_log("Old image not found or empty: " . $old_image_path);
                }
            } else {
                error_log("Failed to move uploaded file. Error code: " . $_FILES["image"]["error"]);
                $_SESSION['message'] = "Sorry, there was an error uploading your file. Error: " . $_FILES["image"]["error"];
                $_SESSION['type'] = "Danger";
                header("Location: ../admin/productslist.php");
                exit;
            }
        } else {
            error_log("No new image uploaded or image upload error");
            if (isset($_FILES['image'])) {
                error_log("Upload error: " . $_FILES['image']['error']);
            }
        }
    
        $query .= " WHERE product_id='$product_id'";
        error_log("Final SQL Query: " . $query);
    
        $update_product = mysqli_query($conn, $query);
    
        if ($update_product) {
            error_log("Product updated successfully");
            $_SESSION['message'] = "Product Updated Successfully!";
            $_SESSION['type'] = "success";
          ?>
        <script>
            location.href = "../admin/productslist.php";
        </script>
        <?php
            exit;
        } else {
            error_log("Error updating product: " . mysqli_error($conn));
            $_SESSION['message'] = "Error occurred during update: " . mysqli_error($conn);
            $_SESSION['type'] = "Danger";
            header("Location: ../admin/productslist.php");
            exit;
        }
    }



    if (isset($_POST['delete_product'])) {
        $product_id = intval($_POST['delete_id']);
    
        // Fetch old image path to delete it
        $query = mysqli_query($conn, "SELECT image FROM products WHERE product_id='$product_id'");
        $product = mysqli_fetch_assoc($query);
    
        if ($product) {
            // Define the correct image path
            $old_image_path = $_SERVER['DOCUMENT_ROOT'] . "/WayGo-Travel-Website/" . $product['image'];
            error_log("Old image path: " . $old_image_path);
    
            // Delete old image file if it exists
            if (!empty($product['image']) && file_exists($old_image_path)) {
                if (unlink($old_image_path)) {
                    error_log("Old image deleted successfully.");
                } else {
                    error_log("Failed to delete old image.");
                }
            } else {
                error_log("Old image not found or already deleted.");
            }
    
            // Delete the product from the database
            $delete_query = mysqli_query($conn, "DELETE FROM products WHERE product_id='$product_id'");
    
            if ($delete_query) {
                $_SESSION['message'] = "Product deleted successfully!";
                $_SESSION['type'] = "success";
                header("Location: ../admin/productslist.php");
                exit;
            } else {
                error_log("Error deleting product: " . mysqli_error($conn));
                $_SESSION['message'] = "Error occurred while deleting. " . $conn->error;
                $_SESSION['type'] = "Danger";
                header("Location: ../admin/productslist.php");
                exit;
            }
        } else {
            error_log("Product not found in the database.");
            $_SESSION['message'] = "Product not found.";
            $_SESSION['type'] = "Danger";
            header("Location: ../admin/productslist.php");
            exit;
        }
    }
    
   
    if (isset($_POST['add_category'])) {
        $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
        $icon = mysqli_real_escape_string($conn, $_POST['category_icon']); // Matches 'icon' column in DB
    
        // Insert into database
        $query = "INSERT INTO categories (category_name, icon, created_at) 
                VALUES ('$category_name', '$icon', NOW())";   
    
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Category added successfully!";
        } else {
            $_SESSION['error'] = "Error adding category: " . mysqli_error($conn);
        }
    
        // Redirect back to the categories page
        header("Location: ../admin/categories.php");
        exit();
    
    }
    
?>  
