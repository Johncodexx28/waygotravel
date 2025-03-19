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
                    <h1 class="h3">Settings</h1>
                </div>

                
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>