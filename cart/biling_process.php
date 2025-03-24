<?php
// Include database connection
include '../views/includes/conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $company_name = $_POST['company_name'] ?? NULL;
    $country = $_POST['country'];
    $street_address = $_POST['street_address'];
    $street_address2 = $_POST['street_address2'] ?? NULL;
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $create_account = isset($_POST['create_account']) ? 1 : 0;
    $ship_different = isset($_POST['ship_different']) ? 1 : 0;
    $order_notes = $_POST['order_notes'] ?? NULL;
    $payment_method = $_POST['payment_method'];
    $terms_accepted = isset($_POST['terms_accepted']) ? 1 : 0;
    $total_price = $_POST['total_price'];
    $delivery_fee = $_POST['delivery_fee'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO orders (
        first_name, last_name, company_name, country, street_address, street_address2, 
        city, state, zip_code, phone, email, create_account, ship_different, 
        order_notes, payment_method, terms_accepted, total_price, delivery_fee
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssssssdds",
        $first_name, $last_name, $company_name, $country, $street_address, $street_address2,
        $city, $state, $zip_code, $phone, $email, $create_account, $ship_different,
        $order_notes, $payment_method, $terms_accepted, $total_price, $delivery_fee
    );

    // Execute the query
    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
