<?php

include '../views/includes/conn.php';

$cart_items = [];
$total_price = 0;

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT c.cart_id, c.product_id, c.quantity, c.color, c.price, c.size,
                p.name AS product_name, p.image 
         FROM cart c
         JOIN products p ON c.product_id = p.product_id 
         WHERE c.user_id = ? AND c.status = 'Incart'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $total_price += ($row['price'] * $row['quantity']);
    }

    $stmt->close();
}


?>
