<?php
session_start();
include '../views/includes/conn.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['return_url'] = $_SERVER['HTTP_REFERER'];
    header("Location: ../index.php?openModal=login");
    $_SESSION['message'] = "Please login to manage your cart";
    $_SESSION['type'] = 'info';
    exit;
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Get cart_id and action from request
$cart_id = isset($_GET['cart_id']) ? intval($_GET['cart_id']) : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Validate the cart_id and action
if ($cart_id <= 0 || !in_array($action, ['increase', 'decrease'])) {
    $_SESSION['message'] = "Invalid request";
    $_SESSION['type'] = "error";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

// Security check: Make sure the cart item belongs to the logged-in user
$check_sql = "SELECT cart_id, quantity FROM cart WHERE cart_id = ? AND user_id = ? AND status = 'Incart'";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $cart_id, $user_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows == 0) {
    // Cart item not found or doesn't belong to user
    $_SESSION['message'] = "Cart item not found";
    $_SESSION['type'] = "error";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    $check_stmt->close();
    exit;
}

$row = $result->fetch_assoc();
$current_quantity = $row['quantity'];
$check_stmt->close();

// Update quantity based on action
if ($action === 'increase') {
    // Increase quantity by 1
    $new_quantity = $current_quantity + 1;
    
    // Optional: Check stock availability before increasing
    // You could add code here to check product inventory
    
    $update_sql = "UPDATE cart SET quantity = ? WHERE cart_id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("iii", $new_quantity, $cart_id, $user_id);
    
    if ($update_stmt->execute()) {
        $_SESSION['message'] = "Quantity updated";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Error updating quantity: " . $conn->error;
        $_SESSION['type'] = "error";
    }
    $update_stmt->close();
} elseif ($action === 'decrease') {
    if ($current_quantity > 1) {
        // Decrease quantity by 1
        $new_quantity = $current_quantity - 1;
        $update_sql = "UPDATE cart SET quantity = ? WHERE cart_id = ? AND user_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("iii", $new_quantity, $cart_id, $user_id);
        
        if ($update_stmt->execute()) {
            $_SESSION['message'] = "Quantity updated";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Error updating quantity: " . $conn->error;
            $_SESSION['type'] = "error";
        }
        $update_stmt->close();
    } else {
        // If quantity will be 0, remove the item completely
        $delete_sql = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("ii", $cart_id, $user_id);
        
        if ($delete_stmt->execute()) {
            $_SESSION['message'] = "Item removed from cart";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Error removing item: " . $conn->error;
            $_SESSION['type'] = "error";
        }
        $delete_stmt->close();
    }
}

// Redirect back to the referring page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>