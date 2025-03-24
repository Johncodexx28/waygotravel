<?php
    session_start();
    include '../views/includes/conn.php';
    
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
    <title>Orders Management - WayGo</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../admin/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>
        <?php include "../assets/components/sweetalert.php"; ?>
        
      
        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid p-0">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Orders Management</h1>
                        <p class="text-muted">Manage all customer orders</p>
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary me-2">
                            <i class="bi bi-calendar3"></i> <?php echo date('F d, Y'); ?>
                        </button>
                        <button class="btn btn-primary">
                            <i class="bi bi-arrow-clockwise"></i> Refresh
                        </button>
                    </div>
                </div>
            
                <!-- Orders Stats Cards -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Orders</h6>
                                        <h3 class="mb-0">1,248</h3>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-cart3 text-primary fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 8.2%
                                    </span>
                                    <span class="text-muted ms-2">from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Completed Orders</h6>
                                        <h3 class="mb-0">968</h3>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-check-circle text-success fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 6.8%
                                    </span>
                                    <span class="text-muted ms-2">from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Pending Orders</h6>
                                        <h3 class="mb-0">182</h3>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-hourglass-split text-warning fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-danger">
                                        <i class="bi bi-arrow-up"></i> 12.1%
                                    </span>
                                    <span class="text-muted ms-2">from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-danger">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Cancelled Orders</h6>
                                        <h3 class="mb-0">98</h3>
                                    </div>
                                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-x-circle text-danger fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-down"></i> 3.2%
                                    </span>
                                    <span class="text-muted ms-2">from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Filter & Search -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="orderStatus" class="form-label">Order Status</label>
                                <select class="form-select" id="orderStatus">
                                    <option value="">All Statuses</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="dateRange" class="form-label">Date Range</label>
                                <select class="form-select" id="dateRange">
                                    <option value="all">All Time</option>
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="week">This Week</option>
                                    <option value="month">This Month</option>
                                    <option value="custom">Custom Range</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="searchOrders" class="form-label">Search Orders</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchOrders" placeholder="Order ID, Customer name, or Email">
                                    <button class="btn btn-primary" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-sliders"></i> More Filters
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Orders</h5>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2">
                                <i class="bi bi-file-earmark-excel"></i> Export
                            </button>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                                <label class="form-check-label" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Items</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>#ORD-2782</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">JD</div>
                                                <div>John Doe</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">Delivered</span></td>
                                        <td>3 items</td>
                                        <td>Mar 15, 2025</td>
                                        <td>$125.99</td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                     <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewOrderModal"><i class="bi bi-eye me-2"></i>View Order</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editOrderModal"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-x-circle me-2"></i>Cancel Order</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>#ORD-2781</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">AS</div>
                                                <div>Anna Smith</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning text-dark">Processing</span></td>
                                        <td>1 item</td>
                                        <td>Mar 14, 2025</td>
                                        <td>$89.50</td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>#ORD-2780</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">RJ</div>
                                                <div>Robert Johnson</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info">Shipped</span></td>
                                        <td>5 items</td>
                                        <td>Mar 13, 2025</td>
                                        <td>$210.40</td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>#ORD-2779</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">MW</div>
                                                <div>Maria Williams</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">Delivered</span></td>
                                        <td>2 items</td>
                                        <td>Mar 12, 2025</td>
                                        <td>$54.25</td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>#ORD-2778</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">TB</div>
                                                <div>Tom Brown</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                        <td>1 item</td>
                                        <td>Mar 11, 2025</td>
                                        <td>$176.80</td>
                                        <td><span class="badge bg-secondary">Refunded</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>#ORD-2777</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">SJ</div>
                                                <div>Sam Johnson</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning text-dark">Processing</span></td>
                                        <td>3 items</td>
                                        <td>Mar 10, 2025</td>
                                        <td>$124.30</td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>#ORD-2776</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">LA</div>
                                                <div>Lisa Anderson</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-secondary">On Hold</span></td>
                                        <td>2 items</td>
                                        <td>Mar 09, 2025</td>
                                        <td>$89.99</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>#ORD-2775</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">MK</div>
                                                <div>Mike King</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">Delivered</span></td>
                                        <td>4 items</td>
                                        <td>Mar 08, 2025</td>
                                        <td>$321.75</td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editOrderModal"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="printInvoice()"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="emailInvoice()"><i class="bi bi-envelope me-2"></i>Email Invoice</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-x-circle me-2"></i>Cancel Order</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-0">Showing 1 to 8 of 248 entries</p>
                            </div>
                            <div>
                                <nav>
                                    <ul class="pagination mb-0">
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
    <?php include "../admin/invoice.php"; ?>


    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Orders Page JavaScript -->
    <script>
        // Select All Checkbox
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('tbody .form-check-input');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Individual checkbox change event
        document.querySelectorAll('tbody .form-check-input').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = [...document.querySelectorAll('tbody .form-check-input')].every(c => c.checked);
                document.getElementById('selectAll').checked = allChecked;
            });
        });
    </script>
</body>
</html>