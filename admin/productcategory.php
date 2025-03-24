<?php
    include '../views/includes/conn.php';
    session_start();

    if (!isset($_SESSION['account_name'])) {
        header("Location: ../admin/login.php"); 
        exit(); 
    }

    // Search functionality
    $search_query = '';
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search_query = mysqli_real_escape_string($conn, $_GET['search']);
    }

    // Sorting functionality
    $sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'category_name';
    $sort_order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    
    // Valid sort columns to prevent SQL injection
    $valid_sort_columns = ['category_name', 'product_count', 'created_at'];
    if (!in_array($sort_by, $valid_sort_columns)) {
        $sort_by = 'category_name';
    }
    
    // Valid sort orders
    $valid_sort_orders = ['ASC', 'DESC'];
    if (!in_array($sort_order, $valid_sort_orders)) {
        $sort_order = 'ASC';
    }

    // Fetch all categories with search and sorting
    $where_clause = !empty($search_query) ? 
        "WHERE c.category_name LIKE '%$search_query%'" : "";
        
    $query = "SELECT c.category_id, c.category_name, c.created_at, c.icon, 
                COUNT(p.product_id) AS product_count 
                FROM categories c 
                LEFT JOIN products p ON c.category_id = p.category_id 
                $where_clause
                GROUP BY c.category_id, c.category_name, c.created_at, c.icon 
                ORDER BY $sort_by $sort_order";
                
    $getcategories = mysqli_query($conn, $query);

    $categories = []; // Initialize an empty array to store categories
    $total_categories = 0;
    $total_products = 0;

    if ($getcategories && mysqli_num_rows($getcategories) > 0) {
        while ($row = mysqli_fetch_assoc($getcategories)) {
            $categories[] = $row; // Store each category as an associative array
            $total_categories++;
            $total_products += $row['product_count'];
        }
    }
    
    // Get view preference (default to grid)
    $view_mode = isset($_GET['view']) ? $_GET['view'] : 'grid';
    if (!in_array($view_mode, ['grid', 'table'])) {
        $view_mode = 'grid';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management | Admin Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../admin/style.css">
    <!-- Sweet-alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
        }
        .category-card {
            position: relative;
        }
        .category-card .category-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .category-card:hover .category-actions {
            opacity: 1;
        }
        .category-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            border-radius: 50%;
            background-color: rgba(13, 110, 253, 0.1);
        }
        .table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        .dashboard-title {
            color: #495057;
            font-weight: 600;
        }
        .stats-card {
            border-left: 4px solid #0d6efd;
        }
        .view-switch .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .search-box {
            position: relative;
        }
        .search-box i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .category-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
        }
        .empty-state {
            text-align: center;
            padding: 40px 0;
        }
        .empty-state i {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 15px;
        }
        .sort-icon {
            font-size: 0.7rem;
            margin-left: 3px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>
        <?php include "../assets/components/sweetalert.php"; ?>
        <?php include "../modal/modal.php"?>
        
        <!-- Main Content -->
        <div class="content w-100">
            <div class="container-fluid p-3">
                <!-- Header -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 dashboard-title mb-1">Product Categories</h1>
                                <p class="text-muted mb-0">Manage your product categories and organization</p>
                            </div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="bi bi-plus-circle me-1"></i> Add Category
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card stats-card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light p-3 rounded-circle">
                                            <i class="bi bi-folder-fill text-primary fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted mb-0">Total Categories</h6>
                                        <h3 class="fw-bold mb-0"><?php echo $total_categories; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stats-card h-100" style="border-left: 4px solid #198754;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light p-3 rounded-circle">
                                            <i class="bi bi-box-seam text-success fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted mb-0">Total Products</h6>
                                        <h3 class="fw-bold mb-0"><?php echo $total_products; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stats-card h-100" style="border-left: 4px solid #dc3545;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light p-3 rounded-circle">
                                            <i class="bi bi-graph-up text-danger fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted mb-0">Average Products</h6>
                                        <h3 class="fw-bold mb-0">
                                            <?php 
                                                echo $total_categories > 0 ? 
                                                    number_format($total_products / $total_categories, 1) : 
                                                    '0';
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Filters and Search -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="" method="GET" class="row g-3">
                            <div class="col-md-8">
                                <div class="input-group search-box">
                                    <input type="text" class="form-control" placeholder="Search categories..." name="search" value="<?php echo htmlspecialchars($search_query); ?>">
                                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort_by); ?>">
                                <input type="hidden" name="order" value="<?php echo htmlspecialchars($sort_order); ?>">
                                <input type="hidden" name="view" value="<?php echo htmlspecialchars($view_mode); ?>">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-filter me-1"></i> Filter
                                </button>
                            </div>
                            <div class="col-md-2">
                                <div class="btn-group w-100 view-switch">
                                    <a href="?view=grid<?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?><?php echo '&sort=' . urlencode($sort_by) . '&order=' . urlencode($sort_order); ?>" class="btn btn-outline-secondary <?php echo $view_mode == 'grid' ? 'active' : ''; ?>">
                                        <i class="bi bi-grid-3x3-gap-fill"></i>
                                    </a>
                                    <a href="?view=table<?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?><?php echo '&sort=' . urlencode($sort_by) . '&order=' . urlencode($sort_order); ?>" class="btn btn-outline-secondary <?php echo $view_mode == 'table' ? 'active' : ''; ?>">
                                        <i class="bi bi-list-ul"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if (count($categories) > 0): ?>
                    <!-- Grid View -->
                    <?php if ($view_mode == 'grid'): ?>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Categories</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-sort-alpha-down me-1"></i> Sort
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                                        <li>
                                            <a class="dropdown-item <?php echo ($sort_by == 'category_name' && $sort_order == 'ASC') ? 'active' : ''; ?>" 
                                               href="?sort=category_name&order=ASC<?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>">
                                                Name (A-Z)
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item <?php echo ($sort_by == 'category_name' && $sort_order == 'DESC') ? 'active' : ''; ?>" 
                                               href="?sort=category_name&order=DESC<?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>">
                                                Name (Z-A)
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item <?php echo ($sort_by == 'product_count' && $sort_order == 'DESC') ? 'active' : ''; ?>" 
                                               href="?sort=product_count&order=DESC<?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>">
                                                Most Products
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item <?php echo ($sort_by == 'product_count' && $sort_order == 'ASC') ? 'active' : ''; ?>" 
                                               href="?sort=product_count&order=ASC<?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>">
                                                Least Products
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item <?php echo ($sort_by == 'created_at' && $sort_order == 'DESC') ? 'active' : ''; ?>" 
                                               href="?sort=created_at&order=DESC<?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>">
                                                Newest First
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item <?php echo ($sort_by == 'created_at' && $sort_order == 'ASC') ? 'active' : ''; ?>" 
                                               href="?sort=created_at&order=ASC<?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>">
                                                Oldest First
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($categories as $category): ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                            <div class="card category-card h-100">
                                                <div class="category-actions">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCategoryModal" 
                                                                   data-id="<?php echo $category['category_id']; ?>" 
                                                                   data-name="<?php echo htmlspecialchars($category['category_name']); ?>" 
                                                                   data-icon="<?php echo htmlspecialchars($category['icon']); ?>">
                                                                    <i class="bi bi-pencil me-2"></i> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item text-danger" href="#" onclick="confirmDeleteCategory(<?php echo $category['category_id']; ?>, '<?php echo htmlspecialchars($category['category_name']); ?>')">
                                                                    <i class="bi bi-trash me-2"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="category-icon">
                                                        <i class="<?php echo htmlspecialchars(!empty($category['icon']) ? $category['icon'] : 'bi bi-folder-fill'); ?> fs-2 text-primary"></i>
                                                    </div>
                                                    <h5 class="card-title"><?php echo htmlspecialchars($category['category_name']); ?></h5>
                                                    <span class="badge bg-light text-dark category-badge">
                                                        <?php echo htmlspecialchars($category['product_count']); ?> Product<?php echo $category['product_count'] != 1 ? 's' : ''; ?>
                                                    </span>
                                                    <p class="card-text text-muted small mt-2">
                                                        Added <?php echo date('M j, Y', strtotime($category['created_at'])); ?>
                                                    </p>
                                                </div>
                                                <div class="card-footer bg-white text-center border-top-0">
                                                    <a href="productslist.php?category=<?php echo $category['category_id']; ?>" class="btn btn-sm btn-outline-primary">
                                                        View Products
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Table View -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Categories List</h5>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-file-earmark-excel me-1"></i> Export
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-printer me-1"></i> Print
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="5%">#</th>
                                                <th scope="col" width="40%">
                                                    <a href="?sort=category_name&order=<?php echo $sort_by == 'category_name' && $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?><?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>" class="text-decoration-none text-dark">
                                                        Category Name
                                                        <?php if($sort_by == 'category_name'): ?>
                                                            <i class="bi bi-caret-<?php echo $sort_order == 'ASC' ? 'up' : 'down'; ?>-fill sort-icon"></i>
                                                        <?php endif; ?>
                                                    </a>
                                                </th>
                                                <th scope="col" width="15%" class="text-center">
                                                    <a href="?sort=product_count&order=<?php echo $sort_by == 'product_count' && $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?><?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>" class="text-decoration-none text-dark">
                                                        Products Count
                                                        <?php if($sort_by == 'product_count'): ?>
                                                            <i class="bi bi-caret-<?php echo $sort_order == 'ASC' ? 'up' : 'down'; ?>-fill sort-icon"></i>
                                                        <?php endif; ?>
                                                    </a>
                                                </th>
                                                <th scope="col" width="25%">
                                                    <a href="?sort=created_at&order=<?php echo $sort_by == 'created_at' && $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?><?php echo !empty($search_query) ? '&search=' . urlencode($search_query) : ''; ?>&view=<?php echo $view_mode; ?>" class="text-decoration-none text-dark">
                                                        Created Date
                                                        <?php if($sort_by == 'created_at'): ?>
                                                            <i class="bi bi-caret-<?php echo $sort_order == 'ASC' ? 'up' : 'down'; ?>-fill sort-icon"></i>
                                                        <?php endif; ?>
                                                    </a>
                                                </th>
                                                <th scope="col" width="15%" class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($categories as $index => $category): ?>
                                                <tr>
                                                    <th scope="row"><?php echo $index + 1; ?></th>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-light text-primary rounded p-2 me-2">
                                                                <i class="<?php echo htmlspecialchars(!empty($category['icon']) ? $category['icon'] : 'bi bi-folder-fill'); ?>"></i>
                                                            </div>
                                                            <?php echo htmlspecialchars($category['category_name']); ?>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-light text-dark">
                                                            <?php echo htmlspecialchars($category['product_count']); ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo date("F j, Y", strtotime($category['created_at'])); ?></td>
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            <a href="productslist.php?category=<?php echo $category['category_id']; ?>" class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="tooltip" title="View Products">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal" 
                                                                data-id="<?php echo $category['category_id']; ?>" 
                                                                data-name="<?php echo htmlspecialchars($category['category_name']); ?>" 
                                                                data-icon="<?php echo htmlspecialchars($category['icon']); ?>"
                                                                data-bs-toggle="tooltip" title="Edit Category">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-outline-danger" onclick="confirmDeleteCategory(<?php echo $category['category_id']; ?>, '<?php echo htmlspecialchars($category['category_name']); ?>')" data-bs-toggle="tooltip" title="Delete Category">
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="card">
                        <div class="card-body">
                            <div class="empty-state">
                                <i class="bi bi-folder"></i>
                                <h5>No Categories Found</h5>
                                <p class="text-muted">
                                    <?php if (!empty($search_query)): ?>
                                        No categories match your search criteria.
                                    <?php else: ?>
                                        You haven't created any product categories yet.
                                    <?php endif; ?>
                                </p>
                                <?php if (!empty($search_query)): ?>
                                    <a href="productcategory.php" class="btn btn-outline-primary">
                                        <i class="bi bi-arrow-left me-1"></i> Clear Search
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                        <i class="bi bi-plus-circle me-1"></i> Create First Category
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../admin/adminprocess.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_icon" class="form-label">Category Icon</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-palette"></i></span>
                                <input type="text" class="form-control" id="category_icon" name="category_icon" placeholder="bi bi-tag">
                            </div>
                            <div class="form-text">Use Bootstrap Icons class names. <a href="https://icons.getbootstrap.com/" target="_blank">Browse icons</a></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Preview</label>
                            <div class="bg-light p-3 text-center rounded">
                                <i id="icon-preview" class="bi bi-folder-fill fs-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="add_category" id="add_category">
                            <i class="bi bi-plus-circle me-1"></i> Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/adminprocess.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="edit_category_id" name="category_id">
                        <div class="mb-3">
                            <label for="edit_category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="edit_category_name" name="category_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_category_icon" class="form-label">Category Icon</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-palette"></i></span>
                                <input type="text" class="form-control" id="edit_category_icon" name="category_icon" placeholder="bi bi-tag">
                            </div>
                            <div class="form-text">Use Bootstrap Icons class names. <a href="https://icons.getbootstrap.com/" target="_blank">Browse icons</a></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Preview</label>
                            <div class="bg-light p-3 text-center rounded">
                                <i id="edit-icon-preview" class="bi bi-folder-fill fs-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="update_category" id="update_category">
                            <i class="bi bi-check-circle me-1"></i> Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Icon preview functionality for add category
        document.getElementById('category_icon').addEventListener('input', function() {
            const iconPreview = document.getElementById('icon-preview');
            iconPreview.className = this.value || 'bi bi-folder-fill fs-1 text-primary';
        });

        // Icon preview functionality for edit category
        document.getElementById('edit_category_icon').addEventListener('input', function() {
            const iconPreview = document.getElementById('edit-icon-preview');
            iconPreview.className = this.value || 'bi bi-folder-fill fs-1 text-primary';
        });

        // Edit category modal data
        $('#editCategoryModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const categoryId = button.data('id');
            const categoryName = button.data('name');
            const categoryIcon = button.data('icon');
            
            const modal = $(this);
            modal.find('#edit_category_id').val(categoryId);
            modal.find('#edit_category_name').val(categoryName);
            modal.find('#edit_category_icon').val(categoryIcon);
            
            // Update icon preview
            const iconPreview = document.getElementById('edit-icon-preview');
            iconPreview.className = categoryIcon || 'bi bi-folder-fill fs-1 text-primary';
        });

        // Delete category confirmation
        function confirmDeleteCategory(categoryId, categoryName) {
            Swal.fire({
                title: 'Delete Category?',
                text: `Are you sure you want to delete "${categoryName}"? This will also affect products in this category.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = ` ../admin/adminprocess.php?delete_category=${categoryId}`;
                }
            });
        }
    </script>
</body>
</html>




                            