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
    <title>Admin Dashboard - Sales</title>
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
                    <h1 class="h3">Sales Overview</h1>
                    <div>
                        <button class="btn btn-outline-secondary me-2">
                            <i class="bi bi-download"></i> Export
                        </button>
                        <button class="btn btn-primary">
                            <i class="bi bi-plus"></i> New Order
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Sales</h6>
                                        <h3 class="mb-0">$24,580</h3>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-currency-dollar text-primary fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 12.5%
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
                                        <h6 class="text-muted mb-1">Total Orders</h6>
                                        <h3 class="mb-0">435</h3>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-bag-check text-success fs-4"></i>
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
                        <div class="card stats-card h-100 border-start border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Average Order</h6>
                                        <h3 class="mb-0">$56.50</h3>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-cart text-warning fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 3.7%
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
                                        <h6 class="text-muted mb-1">Returned Items</h6>
                                        <h3 class="mb-0">12</h3>
                                    </div>
                                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-arrow-return-left text-danger fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-danger">
                                        <i class="bi bi-arrow-up"></i> 2.4%
                                    </span>
                                    <span class="text-muted ms-2">from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>