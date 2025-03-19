<?php 
    include '../views/includes/conn.php';
    session_start();

    // Check if the connection is successful
    if ($conn->connect_error) {
        // Connection failed
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Connection successful
        echo "Connected successfully to the database!";
    }

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
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Account name not found! ");
            </script>
            <?php
        }
        
        $stmt->close();
    }
?>  
