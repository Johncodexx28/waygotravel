

<?php
    include '../views/includes/conn.php';
    session_start();
   
  

    if (!isset($_SESSION['account_name'])) {
        header("Location: ../admin/login.php");
        exit();     
    }

   

    
    

    // For debugging
    echo "<!-- Debug: ";
    if(isset($_SESSION['message'])) {
        echo "Message: " . $_SESSION['message'] . ", Type: " . $_SESSION['type'];
    } else {
        echo "No message set";
    }
    echo " -->";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Sweetalert -->
    <link rel="stylesheet" href="../assets/vendor/sweetalert2/sweetalert2.min.css">
    <script src="../assets/vendor/sweetalert2/sweetalert2.js"></script>
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
        <?php include '../modal/addproduct.php' ?>
        <?php include '../assets/components/sweetalert.php' ?>

  

        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid p-0">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Products</h1>
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addProductModal">
                        Add Product
                    </button>
                </div>
                <!-- Products Table -->
                <div class="table-responsive ">
                    <table class="table table-bordered  text-center justify-content-center table-hover" style="font-size: 10px;">
                        <?php
                            // Secure Query to Join Products with Categories
                            $get_products = "SELECT p.*, c.category_name FROM products p
                                            JOIN categories c ON p.category_id = c.category_id";
                            $run = mysqli_query($conn, $get_products);

                            if ($run && mysqli_num_rows($run) > 0) {
                        ?>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Img</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($run)) { ?>
                            <tr>
                                <td>
                                    <img src="../<?php echo $row['image'] ? $row['image'] : 'default.png'; ?>" width="50" height="50">
                                </td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo number_format($row['price'], 2); ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm editBtn" 
                                        data-id="<?php echo htmlspecialchars($row['product_id']); ?>" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editproductModal<?php echo $row['product_id']; ?>">
                                        Edit
                                    </button>
                                </td>
                                <td>
                                    <form action="../admin/adminprocess.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['product_id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" name="delete_product">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php include '../modal/editmodal.php' ?>
                        <?php } ?>
                        </tbody>
                        <?php 
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (Required for Edit Button Click Event) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
  

</body>
</html>
