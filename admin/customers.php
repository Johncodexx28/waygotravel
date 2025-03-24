<?php
    include '../views/includes/conn.php';
    session_start();
     
    if (!isset($_SESSION['account_name'])) {
        header("Location: ../admin/login.php"); 
        exit(); 
    }

    // Filter logic
    $where_clause = "1=1"; // Default - show all records
    
    // Search functionality
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $where_clause .= " AND (full_name LIKE '%$search%' OR email LIKE '%$search%' OR phone_number LIKE '%$search%' OR address LIKE '%$search%')";
    }
    
    // Filter by status if set
    if (isset($_GET['status']) && !empty($_GET['status'])) {
        $status = mysqli_real_escape_string($conn, $_GET['status']);
        $where_clause .= " AND status='$status'";
    }

    // Pagination
    $records_per_page = 10;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * $records_per_page;
    
    // Get total records for pagination
    $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE $where_clause");
    $total_row = mysqli_fetch_assoc($total_query);
    $total_records = $total_row['total'];
    $total_pages = ceil($total_records / $records_per_page);
    
    // Get filtered data with pagination
    $get_data = mysqli_query($conn, "SELECT * FROM users WHERE $where_clause ORDER BY full_name ASC LIMIT $offset, $records_per_page");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management | Admin Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../admin/style.css">
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
        }
        .table-container {
            overflow-x: auto;
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
        .filter-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        .badge {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
        .btn-action {
            padding: 5px 10px;
            font-size: 0.875rem;
        }
        .pagination {
            margin-bottom: 0;
        }
        .action-cell {
            white-space: nowrap;
        }
        .dashboard-title {
            color: #495057;
            font-weight: 600;
        }
        .stats-card {
            border-left: 4px solid #0d6efd;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>  

        <!-- Main Content -->
        <div class="content w-100">
            <div class="container-fluid p-3">
                <!-- Header -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 dashboard-title">Customer Management</h1>
                                <p class="text-muted mb-0">Manage all customer accounts and information</p>
                            </div>
                            <a href="add_customer.php" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Add New Customer
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <?php
                        // Quick stats
                        $total_customers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'];
                        $new_customers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)"))['count'];
                    ?>
                    <div class="col-md-4">
                        <div class="card stats-card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light p-3 rounded-circle">
                                            <i class="bi bi-people text-primary fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted mb-0">Total Customers</h6>
                                        <h3 class="fw-bold mb-0"><?php echo $total_customers; ?></h3>
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
                                            <i class="bi bi-person-add text-success fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted mb-0">New (30 days)</h6>
                                        <h3 class="fw-bold mb-0"><?php echo $new_customers; ?></h3>
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
                                            <i class="bi bi-star text-warning fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-muted mb-0">Active Status</h6>
                                        <div class="mt-1">
                                            <span class="badge bg-success me-1">Active</span>
                                            <span class="badge bg-secondary">Inactive</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Filter & Search</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET" class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group search-box">
                                    <input type="text" class="form-control" placeholder="Search by name, email, phone or address" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="status">
                                    <option value="">All Status</option>
                                    <option value="active" <?php echo (isset($_GET['status']) && $_GET['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo (isset($_GET['status']) && $_GET['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-filter me-1"></i> Apply Filters
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Customers Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Customer List</h5>
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
                        <div class="table-container">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="20%">Name</th>
                                        <th scope="col" width="20%">Email</th>
                                        <th scope="col" width="15%">Phone Number</th>
                                        <th scope="col" width="25%">Address</th>
                                        <th scope="col" width="10%">Status</th>
                                        <th scope="col" width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (mysqli_num_rows($get_data) > 0) {
                                    $counter = $offset + 1;
                                    while($row = mysqli_fetch_array($get_data)) {
                                        // Default status to active if not set in database
                                        $status = isset($row['status']) ? $row['status'] : 'active';
                                ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-light text-dark d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                    <?php echo substr($row['full_name'], 0, 1); ?>
                                                </div>
                                                <?php echo htmlspecialchars($row['full_name']); ?>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                                        <td>
                                            <?php if($status == 'active'): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="action-cell">
                                            <div class="btn-group">
                                                <a href="view_customer.php?id=<?php echo $row['user_id']; ?>" class="btn btn-sm btn-outline-primary btn-action">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="edit_customer.php?id=<?php echo $row['user_id']; ?>" class="btn btn-sm btn-outline-secondary btn-action">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['user_id']; ?>)" class="btn btn-sm btn-outline-danger btn-action">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="py-5">
                                                <i class="bi bi-search" style="font-size: 2rem;"></i>
                                                <p class="mt-2">No customers found</p>
                                                <?php if(isset($_GET['search']) || isset($_GET['status'])): ?>
                                                    <a href="customers.php" class="btn btn-sm btn-outline-primary mt-2">Clear filters</a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php if($total_pages > 1): ?>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $records_per_page, $total_records); ?> of <?php echo $total_records; ?> entries
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['status']) ? '&status=' . urlencode($_GET['status']) : ''; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['status']) ? '&status=' . urlencode($_GET['status']) : ''; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['status']) ? '&status=' . urlencode($_GET['status']) : ''; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this customer? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="deleteButton" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Delete confirmation
        function confirmDelete(userId) {
            const deleteButton = document.getElementById('deleteButton');
            deleteButton.href = 'delete.php?id=' + userId;
            
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
        
        // Make table rows clickable
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('click', function(e) {
                    // Don't trigger when clicking action buttons
                    if (e.target.closest('.btn-group') || e.target.closest('a') || e.target.closest('button')) {
                        return;
                    }
                    
                    const userId = this.querySelector('.btn-group a:first-child').getAttribute('href').split('=')[1];
                    window.location.href = 'view_customer.php?id=' + userId;
                });
                
                // Add hover cursor
                row.style.cursor = 'pointer';
            });
        });
    </script>
</body>
</html>