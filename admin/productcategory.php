<?php
// This would be your database connection and other initializations
// session_start();
// include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Categories</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
        }
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #212529;
            color: #fff;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .logo-container {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }
        .logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .sidebar-nav {
            padding: 15px 0;
        }
        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        .sidebar-nav .nav-link:hover, 
        .sidebar-nav .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar-nav .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        .dropdown-toggle::after {
            margin-left: auto;
        }
        .dropdown-menu {
            background-color: #2c3237;
            border: none;
            margin-left: 20px;
            width: calc(100% - 40px);
        }
        .dropdown-item {
            color: rgba(255, 255, 255, 0.7);
            padding: 8px 20px;
        }
        .dropdown-item:hover, .dropdown-item:focus {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
            width: calc(100% - var(--sidebar-width));
        }
        .logout-container {
            padding: 15px 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .table-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-top: 20px;
            width: 100%;
        }
        .table {
            width: 100%;
            margin-bottom: 0;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        .category-card {
            transition: all 0.3s;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(var(--sidebar-width) * -1);
            }
            .sidebar.active {
                margin-left: 0;
            }
            .content {
                margin-left: 0;
                width: 100%;
            }
            .content.active {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Logo -->
            <div class="logo-container">
                <img src="img/logo.png" alt="WayGo Logo" class="logo">
                <h4 class="m-0">WayGo</h4>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="../admin/dash.php" class="nav-link active">
                            <i class="bi bi-grid"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#productsSubMenu" aria-expanded="false">
                            <i class="bi bi-cart-check-fill"></i> Products
                        </a>
                        <div class="collapse" id="productsSubMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="../admin/productslist.php" class="nav-link dropdown-item">
                                        <i class="bi bi-list-ul"></i> Product List
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/productcategory.php" class="nav-link dropdown-item">
                                        <i class="bi bi-tags"></i> Categories
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/sales.php" class="nav-link">
                            <i class="bi bi-receipt"></i> Sales
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/customers.php" class="nav-link">
                            <i class="bi bi-person-fill"></i> Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="notifications.php" class="nav-link">
                            <i class="bi bi-app-indicator"></i> Notifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="settings.php" class="nav-link">
                            <i class="bi bi-sliders2"></i> Settings
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Logout -->
            <div class="logout-container">
                <a href="adminlogin.php" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right"></i> Log Out
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid p-0">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Product Categories</h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="bi bi-plus"></i> Add Category
                    </button>
                </div>

                <!-- Categories Grid View -->
                <div class="row">
                    <?php
                    // This would be replaced with actual database query
                    $categories = [
                        ['id' => 1, 'name' => 'Electronics', 'products' => 24, 'icon' => 'bi-laptop'],
                        ['id' => 2, 'name' => 'Clothing', 'products' => 38, 'icon' => 'bi-basket'],
                        ['id' => 3, 'name' => 'Home & Garden', 'products' => 15, 'icon' => 'bi-house'],
                        ['id' => 4, 'name' => 'Sports', 'products' => 12, 'icon' => 'bi-bicycle'],
                        ['id' => 5, 'name' => 'Books', 'products' => 9, 'icon' => 'bi-book'],
                        ['id' => 6, 'name' => 'Toys', 'products' => 7, 'icon' => 'bi-puzzle']
                    ];

                    foreach ($categories as $category) {
                        echo '
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card category-card h-100">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="bi ' . $category['icon'] . ' fs-1 text-primary"></i>
                                    </div>
                                    <h5 class="card-title">' . $category['name'] . '</h5>
                                    <p class="card-text">' . $category['products'] . ' Products</p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex justify-content-around">
                                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                </div>

                <!-- Categories Table View -->
                <div class="table-container mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Categories List</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="viewOptions" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-eye"></i> View Options
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="viewOptions">
                                <li><a class="dropdown-item" href="#">Grid View</a></li>
                                <li><a class="dropdown-item active" href="#">Table View</a></li>
                            </ul>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Products</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // This would be replaced with actual database query
                            foreach ($categories as $index => $category) {
                                echo '
                                <tr>
                                    <th scope="row">' . ($index + 1) . '</th>
                                    <td>
                                        <i class="bi ' . $category['icon'] . ' text-primary me-2"></i>
                                        ' . $category['name'] . '
                                    </td>
                                    <td>' . $category['products'] . '</td>
                                    <td>Mar 10, 2025</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryIcon" class="form-label">Icon</label>
                            <select class="form-select" id="categoryIcon">
                                <option value="bi-laptop">Electronics</option>
                                <option value="bi-basket">Clothing</option>
                                <option value="bi-house">Home & Garden</option>
                                <option value="bi-bicycle">Sports</option>
                                <option value="bi-book">Books</option>
                                <option value="bi-puzzle">Toys</option>
                                <option value="bi-gem">Jewelry</option>
                                <option value="bi-cup-hot">Food & Beverages</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="categoryDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="categoryDescription" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Category</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="editCategoryName" value="Electronics" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryIcon" class="form-label">Icon</label>
                            <select class="form-select" id="editCategoryIcon">
                                <option value="bi-laptop" selected>Electronics</option>
                                <option value="bi-basket">Clothing</option>
                                <option value="bi-house">Home & Garden</option>
                                <option value="bi-bicycle">Sports</option>
                                <option value="bi-book">Books</option>
                                <option value="bi-puzzle">Toys</option>
                                <option value="bi-gem">Jewelry</option>
                                <option value="bi-cup-hot">Food & Beverages</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editCategoryDescription" rows="3">Electronic devices and accessories including smartphones, laptops, and more.</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update Category</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>