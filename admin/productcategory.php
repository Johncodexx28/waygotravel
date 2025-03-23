<?php
    include '../views/includes/conn.php';
    session_start();

    if (!isset($_SESSION['account_name'])) {
        header("Location: ../admin/login.php"); 
        exit(); 
    }

    // Fetch all categories and store them in an array
    $getcategories = mysqli_query($conn, "SELECT c.category_id, c.category_name, c.created_at, c.icon, 
                                      COUNT(p.product_id) AS product_count 
                                      FROM categories c 
                                      LEFT JOIN products p ON c.category_id = p.category_id 
                                      GROUP BY c.category_id, c.category_name, c.created_at, c.icon;");


    $categories = []; // Initialize an empty array to store categories

    if ($getcategories && mysqli_num_rows($getcategories) > 0) {
        while ($row = mysqli_fetch_assoc($getcategories)) {
            $categories[] = $row; // Store each category as an associative array
        }
    } else {
        $categories = []; // Set an empty array if no categories are found
    }
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
                    <h1 class="h3">Product Categories</h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="bi bi-plus"></i> Add Category
                    </button>
                </div>

                <!-- Categories Grid View -->
                <div class="row">
                    <?php foreach ($categories as $category): ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card category-card h-100">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="<?php echo htmlspecialchars(!empty($category['icon']) ? $category['icon'] : 'bi bi-folder-fill'); ?> fs-1 text-primary"></i>
                                    </div>
                                    <h5 class="card-title"><?php echo htmlspecialchars($category['category_name']); ?></h5>
                                    <p class="fw-bold"><?php echo htmlspecialchars($category['product_count']); ?></p>
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
                        </div>
                    <?php endforeach; ?>
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
                                <th scope="col">Products Count</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $index => $category): ?>
                                <tr>
                                    <th scope="row"><?php echo $index + 1; ?></th>
                                    <td>
                                    <i class="<?php echo htmlspecialchars(!empty($category['icon']) ? $category['icon'] : 'bi bi-folder-fill'); ?> fs-6 text-primary"></i>
                                         <?php echo htmlspecialchars($category['category_name']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($category['product_count']); ?></td>
                                    <td><?php echo date("F j, Y g:i A", strtotime($category['created_at'])); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Add Category Modal -->
                    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCategoryLabel">Add Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../admin/adminprocess.php" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="category_name" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_icon" class="form-label">Category Icon (Optional)</label>
                                            <input type="text" class="form-control" id="category_icon" name="category_icon">
                                            <small class="text-muted">Use Bootstrap Icons class names (e.g., bi bi-tag).</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="add_category" id="add_category">Add Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
