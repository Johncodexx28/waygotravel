<?php
session_start();
include '../../views/includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($cart_id > 0) {
        // Get current quantity
        $sql = "SELECT quantity FROM cart WHERE cart_id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $cart_id, $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $current_quantity = $row['quantity'];
            $new_quantity = $current_quantity;
            
            if ($action === 'increase') {
                $new_quantity = $current_quantity + 1;
            } else if ($action === 'decrease') {
                $new_quantity = max(1, $current_quantity - 1);
            }
            
            if ($new_quantity != $current_quantity) {
                $update_sql = "UPDATE cart SET quantity = ? WHERE cart_id = ? AND user_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("iii", $new_quantity, $cart_id, $_SESSION['user_id']);
                
                if ($update_stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Quantity updated']);
                    exit;
                }
            } else {
                echo json_encode(['success' => true, 'message' => 'No change needed']);
                exit;
            }
        }
    }
}

echo json_encode(['success' => false, 'message' => 'Failed to update cart']);