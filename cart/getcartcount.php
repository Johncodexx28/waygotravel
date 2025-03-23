<?php

include '../views/includes/conn.php';

$count = 0;

if (isset($_SESSION['user_id'])) {
    $sql = "SELECT COUNT(*) as count FROM cart WHERE user_id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $count = $row['count'];
    }
    
    $stmt->close();
}


?>