<?php
    include '../views/includes/conn.php';
    session_start();

    if (!isset($_SESSION['account_name'])) {
        header("Location: ../admin/login.php");
        exit(); 
    }

    if (isset($_SESSION['message'])) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    alert('" . $_SESSION['message'] . "' );
                });
              </script>";
        unset($_SESSION['message']); 
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
        <?php include '../modal/addproduct.php' ?>
       

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
                <div class="table-container">
                    <table class="table table-hover">
                    <?php
                        // Secure Query to Join Products with Categories
                        $get_products = "SELECT p.*, c.category_name FROM products p
                                         JOIN categories c ON p.category_id = c.category_id";
                        $run = mysqli_query($conn, $get_products);

                        if ($run && mysqli_num_rows($run) > 0) {
                    ?>
                        <thead>
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
                                    <button type="button" class="btn btn-primary editBtn" data-id="<?php echo htmlspecialchars($row['product_id']); ?>" data-bs-toggle="modal" data-bs-target="#editproductModal">Edit</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger editBtn" data-id="<?php echo htmlspecialchars($row['product_id']); ?>" data-bs-toggle="modal" data-bs-target="#editproductModal">Edit</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <?php include '../modal/editmodal.php' ?>
                    <?php 
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                        }
                    ?>
                    </table>

                    <?php include '../modal/editmodal.php' ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (Required for Edit Button Click Event) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    
    <script>
   
    document.addEventListener('DOMContentLoaded', function() {
        
        const editButtons = document.querySelectorAll('.editBtn');
        
       
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get product ID from data-id attribute
                const productId = this.getAttribute('data-id');
                
                // Get product data from the current row (faster than AJAX)
                const row = this.closest('tr');
                const productName = row.querySelector('td:nth-child(2)').textContent;
                const productDesc = row.querySelector('td:nth-child(4)').textContent;
                const productPrice = row.querySelector('td:nth-child(5)').textContent.replace('$', '').trim();
                const productImg = row.querySelector('td:nth-child(1) img').getAttribute('src');
                
              
                document.getElementById('update_id').value = productId;
                document.getElementById('name').value = productName;
                document.getElementById('description').value = productDesc;
                document.getElementById('price').value = productPrice;
                document.getElementById('modalImagePreview').src = productImg;
            });
        });

        // Image preview function
        document.getElementById('new_image').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('modalImagePreview').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        
    });
    </script>

</body>
</html>
