<?php
    include '../views/includes/conn.php';
    session_start();



     
    if (!isset($_SESSION['account_name'])) {
        header("Location: ../admin/login.php"); 
        exit(); 
    }

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../admin/style.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>  

        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid p-0">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Customers</h1>
                </div>

                <!-- Products Table -->
                <div class="table-container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                            $get_data  = mysqli_query($conn, "SELECT * FROM users");
                            

                            while($row = mysqli_fetch_array($get_data)){
                                ?>
                             <!--
                                <tr>
                                    <td colspan="6" class="text-center py-4">No data available</td>
                                </tr> -->
                                    
                                <tr>
                                    <td > <?php echo $row['full_name'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['phone_number'];?></td>
                                    <td><?php echo $row['address'];?></td>
                                    <td><button class="btn btn-danger " href="delete.php?id=<?php echo $row['user_id']; ?>" >Delete</button></td>

                                </tr>
                            
                                 <?php
                            }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>