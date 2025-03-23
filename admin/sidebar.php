<div class="sidebar">
            <!-- Logo -->
            <div class="logo-container">
                <!-- <img src="img/logo.png" alt="WayGo Logo" class="logo"> -->
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
                        <a href="settings.php" class="nav-link">
                            <i class="bi bi-sliders2"></i> Settings
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Logout -->
            <div class="logout-container">
                <a href="../admin/adminout.php" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right"></i> Log Out
                </a>
            </div>
        </div>

       