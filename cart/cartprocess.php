<?php
session_start();
include '../views/includes/conn.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page with return URL
        $_SESSION['return_url'] = $_SERVER['HTTP_REFERER'];
        header("Location: ../index.php?openModal=login");
        $_SESSION['message'] = "please login";
        $_SESSION['type'] = 'info';
        exit;
    }

    // Get user ID from session
    $user_id = $_SESSION['user_id'];

    // Get form data and sanitize
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $color = isset($_POST['color']) ? mysqli_real_escape_string($conn, $_POST['color']) : ''; // Sanitize strings
    $price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0;
    $size = isset($_POST['size']) ? mysqli_real_escape_string($conn, $_POST['size']) : 'Standard'; // Default if not set
    $status = 'Incart'; // Default status when adding to cart

    // Validate the data
    if ($product_id <= 0 || $quantity <= 0 || $price <= 0) {
        $_SESSION['error'] = "Invalid product information";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Check if the product is already in the cart
    $check_sql = "SELECT cart_id, quantity FROM cart 
                 WHERE user_id = ? AND product_id = ? AND color = ? AND size = ? AND status = 'Incart'";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("iiss", $user_id, $product_id, $color, $size);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing cart item
        $row = $result->fetch_assoc();
        $cart_id = $row['cart_id'];
        $new_quantity = $row['quantity'] + $quantity;

        $update_sql = "UPDATE cart SET quantity = ?, added_at = NOW() WHERE cart_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_quantity, $cart_id);

        if ($update_stmt->execute()) {
            $_SESSION['message'] = "Cart updated successfully";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Error updating cart: " . $conn->error;
            $_SESSION['type'] = "error";
        }
        $update_stmt->close();
    } else {
        // Insert new cart item
        $insert_sql = "INSERT INTO cart (user_id, product_id, quantity, color, price, size, status, added_at) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iiisdss", $user_id, $product_id, $quantity, $color, $price, $size, $status);

        if ($insert_stmt->execute()) {
            $_SESSION['message'] = "Product added to cart successfully";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Error adding to cart: " . $conn->error;
            $_SESSION['type'] = "error";
        }
        $insert_stmt->close();
    }

    $check_stmt->close();

    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // If accessed directly without POST
    header("Location: ../assets/views/productslist.php");
    exit;
}
?>
