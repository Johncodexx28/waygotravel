<?php

session_start();

$conn= mysqli_connect("localhost", "root","");
$db = mysqli_select_db($conn,"waygo");

include '../views/includes/conn.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page with return URL
    $_SESSION['return_url'] = $_SERVER['HTTP_REFERER'];
    header("Location: ../index.php?openModal=login");
    $_SESSION['message'] = "Please login to manage your cart";
    $_SESSION['type'] = 'info';
    exit;
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Get cart_id from request
$cart_id = isset($_GET['cart_id']) ? intval($_GET['cart_id']) : 0;

// Validate the cart_id
if ($cart_id <= 0) {
    $_SESSION['message'] = "Invalid cart item";
    $_SESSION['type'] = "error";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

// Security check: Make sure the cart item belongs to the logged-in user
$check_sql = "SELECT cart_id FROM cart WHERE cart_id = ? AND user_id = ?";
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
$check_stmt->close();

// Remove the item from cart
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

// Redirect back to the referring page (usually the cart page)
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>