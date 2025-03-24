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

    // Get categories for the filter
    $get_categories = "SELECT * FROM categories ORDER BY category_name";
    $categories_result = mysqli_query($conn, $get_categories);
    $categories = [];
    if ($categories_result && mysqli_num_rows($categories_result) > 0) {
        while ($cat = mysqli_fetch_assoc($categories_result)) {
            $categories[] = $cat;
        }
    }

    // Filtering logic
    $category_filter = isset($_GET['category']) ? intval($_GET['category']) : 0;
    $price_range = isset($_GET['price_range']) ? $_GET['price_range'] : 'all';
    $search_term = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'name_asc';

    // Base query
    $get_products = "SELECT p.*, c.category_name FROM products p
                     JOIN categories c ON p.category_id = c.category_id
                     WHERE 1=1";

    // Apply filters
    if ($category_filter > 0) {
        $get_products .= " AND p.category_id = $category_filter";
    }

    if ($price_range != 'all') {
        switch ($price_range) {
            case 'under_50':
                $get_products .= " AND p.price < 50";
                break;
            case '50_100':
                $get_products .= " AND p.price >= 50 AND p.price <= 100";
                break;
            case '100_200':
                $get_products .= " AND p.price > 100 AND p.price <= 200";
                break;
            case 'over_200':
                $get_products .= " AND p.price > 200";
                break;
        }
    }

    if (!empty($search_term)) {
        $get_products .= " AND (p.name LIKE '%$search_term%' OR p.description LIKE '%$search_term%')";
    }

    // Apply sorting
    switch ($sort_by) {
        case 'name_asc':
            $get_products .= " ORDER BY p.name ASC";
            break;
        case 'name_desc':
            $get_products .= " ORDER BY p.name DESC";
            break;
        case 'price_asc':
            $get_products .= " ORDER BY p.price ASC";
            break;
        case 'price_desc':
            $get_products .= " ORDER BY p.price DESC";
            break;
        case 'newest':
            $get_products .= " ORDER BY p.product_id DESC";
            break;
    }

    $run = mysqli_query($conn, $get_products);
    $total_products = mysqli_num_rows($run);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management - WayGo</title>
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
                    <div>
                        <h1 class="h3 mb-0">Products Management</h1>
                        <p class="text-muted">Manage and organize your product inventory</p>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="bi bi-plus-lg me-2"></i>Add Product
                    </button>
                </div>

                <!-- Product Stats Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Products</h6>
                                        <h3 class="mb-0"><?php echo $total_products; ?></h3>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-box-seam text-primary fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Categories</h6>
                                        <h3 class="mb-0"><?php echo count($categories); ?></h3>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-tags text-success fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-info">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Average Price</h6>
                                        <?php
                                            $avg_price_query = "SELECT AVG(price) as avg_price FROM products";
                                            $avg_price_result = mysqli_query($conn, $avg_price_query);
                                            $avg_price = 0;
                                            if ($avg_price_result && $avg_row = mysqli_fetch_assoc($avg_price_result)) {
                                                $avg_price = $avg_row['avg_price'];
                                            }
                                        ?>
                                        <h3 class="mb-0">$<?php echo number_format($avg_price, 2); ?></h3>
                                    </div>
                                    <div class="bg-info bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-currency-dollar text-info fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Low Stock Items</h6>
                                        <?php
                                            // Assuming you have a stock field in your products table
                                            $low_stock_query = "SELECT COUNT(*) as count FROM products WHERE stock < 10";
                                            $low_stock_result = mysqli_query($conn, $low_stock_query);
                                            $low_stock = 0;
                                            if ($low_stock_result && $low_stock_row = mysqli_fetch_assoc($low_stock_result)) {
                                                $low_stock = $low_stock_row['count'];
                                            }
                                        ?>
                                        <h3 class="mb-0"><?php echo $low_stock; ?></h3>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter and Search Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="0">All Categories</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['category_id']; ?>" <?php echo ($category_filter == $category['category_id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category['category_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="price_range" class="form-label">Price Range</label>
                                <select class="form-select" id="price_range" name="price_range">
                                    <option value="all" <?php echo ($price_range == 'all') ? 'selected' : ''; ?>>All Prices</option>
                                    <option value="under_50" <?php echo ($price_range == 'under_50') ? 'selected' : ''; ?>>Under $50</option>
                                    <option value="50_100" <?php echo ($price_range == '50_100') ? 'selected' : ''; ?>>$50 - $100</option>
                                    <option value="100_200" <?php echo ($price_range == '100_200') ? 'selected' : ''; ?>>$100 - $200</option>
                                    <option value="over_200" <?php echo ($price_range == 'over_200') ? 'selected' : ''; ?>>Over $200</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="sort_by" class="form-label">Sort By</label>
                                <select class="form-select" id="sort_by" name="sort_by">
                                    <option value="name_asc" <?php echo ($sort_by == 'name_asc') ? 'selected' : ''; ?>>Name (A-Z)</option>
                                    <option value="name_desc" <?php echo ($sort_by == 'name_desc') ? 'selected' : ''; ?>>Name (Z-A)</option>
                                    <option value="price_asc" <?php echo ($sort_by == 'price_asc') ? 'selected' : ''; ?>>Price (Low to High)</option>
                                    <option value="price_desc" <?php echo ($sort_by == 'price_desc') ? 'selected' : ''; ?>>Price (High to Low)</option>
                                    <option value="newest" <?php echo ($sort_by == 'newest') ? 'selected' : ''; ?>>Newest First</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="search" class="form-label">Search Products</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" name="search" 
                                           placeholder="Product name or description" value="<?php echo htmlspecialchars($search_term); ?>">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Products List</h5>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2">
                                <i class="bi bi-file-earmark-excel"></i> Export
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <?php if ($run && mysqli_num_rows($run) > 0) { ?>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="80">Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = mysqli_fetch_assoc($run)) { ?>
                                    <tr>
                                        <td>
                                            <img src="../<?php echo $row['image'] ? $row['image'] : 'assets/images/products/default.png'; ?>" 
                                                 class="img-thumbnail" alt="<?php echo htmlspecialchars($row['name']); ?>" width="60" height="60">
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($row['name']); ?></strong>
                                            <div class="text-muted small">ID: <?php echo $row['product_id']; ?></div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                <?php echo htmlspecialchars($row['category_name']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php 
                                                // Trim description to first 50 characters for cleaner display
                                                $desc = htmlspecialchars($row['description']);
                                                echo (strlen($desc) > 50) ? substr($desc, 0, 50) . '...' : $desc;
                                            ?>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-primary">
                                                $<?php echo number_format($row['price'], 2); ?>
                                            </div>
                                            <?php if (isset($row['stock']) && $row['stock'] < 10): ?>
                                                <span class="badge bg-danger">Low Stock</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary editBtn me-2" 
                                                    data-id="<?php echo htmlspecialchars($row['product_id']); ?>" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editproductModal<?php echo $row['product_id']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <form action="../admin/adminprocess.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['product_id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" name="delete_product"
                                                            onclick="return confirm('Are you sure you want to delete this product?');">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php include '../modal/editmodal.php' ?>
                                <?php } ?>
                                </tbody>
                                <?php } else { ?>
                                    <div class="alert alert-info m-3">
                                        <i class="bi bi-info-circle me-2"></i>
                                        No products found with the selected filters. Try adjusting your search criteria.
                                    </div>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-0">Showing <?php echo $total_products; ?> products</p>
                            </div>
                            <div>
                                <nav aria-label="Product navigation">
                                    <ul class="pagination pagination-sm mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (Required for Edit Button Click Event) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Auto-submit form when filters change
        document.querySelectorAll('#category, #price_range, #sort_by').forEach(element => {
            element.addEventListener('change', function() {
                this.form.submit();
            });
        });
        
        // Clear filters button functionality
        document.getElementById('clearFilters').addEventListener('click', function() {
            window.location.href = window.location.pathname;
        });
    </script>
</body>
</html>