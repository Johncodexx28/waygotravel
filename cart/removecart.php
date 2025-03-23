<?php
session_start();
include '../../views/includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
    
    if ($cart_id > 0) {
        $sql = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $cart_id, $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
            exit;
        }
    }
}

echo json_encode(['success' => false, 'message' => 'Failed to remove item']);