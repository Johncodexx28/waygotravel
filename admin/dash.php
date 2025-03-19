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
    <title>Admin Dashboard - WayGo</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .stats-card {
            transition: all 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
        .chart-container {
            height: 300px;
            width: 100%;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #212529;
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
                    <div>
                        <h1 class="h3 mb-0">Dashboard</h1>
                        <p class="text-muted">Welcome back, Admin!</p>
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

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Revenue</h6>
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
                                        <h6 class="text-muted mb-1">Total Products</h6>
                                        <h3 class="mb-0">325</h3>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-boxes text-success fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 5.2%
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
                                        <h6 class="text-muted mb-1">New Customers</h6>
                                        <h3 class="mb-0">85</h3>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-people text-warning fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 8.7%
                                    </span>
                                    <span class="text-muted ms-2">from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 border-start border-4 border-info">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Pending Orders</h6>
                                        <h3 class="mb-0">18</h3>
                                    </div>
                                    <div class="bg-info bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-hourglass-split text-info fs-4"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="text-danger">
                                        <i class="bi bi-arrow-down"></i> 2.4%
                                    </span>
                                    <span class="text-muted ms-2">from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row mb-4">
                    <div class="col-xl-8 col-lg-7 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Revenue Overview</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        This Year
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Quarter</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="revenueChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Sales by Category</h5>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="categoryChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders & Top Products -->
                <div class="row">
                    <div class="col-xl-8 col-lg-7 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Recent Orders</h5>
                                <a href="sales.php" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#ORD-2782</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-2">JD</div>
                                                        <div>John Doe</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">Delivered</span></td>
                                                <td>Mar 15, 2025</td>
                                                <td>$125.99</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#ORD-2781</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-2">AS</div>
                                                        <div>Anna Smith</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning text-dark">Processing</span></td>
                                                <td>Mar 14, 2025</td>
                                                <td>$89.50</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#ORD-2780</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-2">RJ</div>
                                                        <div>Robert Johnson</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-info">Shipped</span></td>
                                                <td>Mar 13, 2025</td>
                                                <td>$210.40</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#ORD-2779</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-2">MW</div>
                                                        <div>Maria Williams</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">Delivered</span></td>
                                                <td>Mar 12, 2025</td>
                                                <td>$54.25</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#ORD-2778</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-2">TB</div>
                                                        <div>Tom Brown</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">Cancelled</span></td>
                                                <td>Mar 11, 2025</td>
                                                <td>$176.80</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Top Selling Products</h5>
                                <a href="products.php" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded p-2 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-box-seam fs-4"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Premium Headphones</h6>
                                                <p class="text-muted mb-0">Category: Electronics</p>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">$129.99</h6>
                                                <p class="text-success mb-0">147 sold</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded p-2 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-smartwatch fs-4"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Smartwatch Pro</h6>
                                                <p class="text-muted mb-0">Category: Wearables</p>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">$199.99</h6>
                                                <p class="text-success mb-0">129 sold</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded p-2 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-speaker fs-4"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Bluetooth Speaker</h6>
                                                <p class="text-muted mb-0">Category: Audio</p>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">$79.99</h6>
                                                <p class="text-success mb-0">112 sold</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded p-2 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-laptop fs-4"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Ultrabook Slim</h6>
                                                <p class="text-muted mb-0">Category: Computers</p>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">$899.99</h6>
                                                <p class="text-success mb-0">98 sold</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded p-2 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-camera fs-4"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Digital Camera</h6>
                                                <p class="text-muted mb-0">Category: Photography</p>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">$449.99</h6>
                                                <p class="text-success mb-0">87 sold</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Charts JS -->
    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue',
                    data: [18500, 19200, 21000, 20100, 22300, 24000, 25100, 23800, 24580, 0, 0, 0],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 2]
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '$' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Electronics', 'Clothing', 'Accessories', 'Home & Garden', 'Other'],
                datasets: [{
                    data: [45, 25, 15, 10, 5],
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#36b9cc',
                        '#f6c23e',
                        '#e74a3b'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    </script>
</body>
</html>