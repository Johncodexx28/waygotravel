<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin Dashboard</title>

    <!--This script is for the drop down (products)-->
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("dropdown-menu");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
    </script>

</head>
<body>
    <aside>
        <!--Logo-->
        <div class="logo-container">
            <img src="img/logo.png" class="logo">
        <h2>WayGo</h2>
        </div>

        <nav> <!--Navigation-->
            <ul>
                <li><a href="dashboard.html"> <i class="bi bi-justify"></i> Dashboard</a></li>
                <li>
                    <!--The dropdown of product-->
                    <a href="#" onclick="toggleDropdown()"> <i class="bi bi-cart-check-fill"></i> Products </a>
                    <ul id="dropdown-menu" style="display: none; padding-left: 20px;">
                        <li><a href="#">Product List</a></li>
                        <li><a href="#">Categories</a></li>
                    </ul>
                </li>
                <li><a href="sales.html"> <i class="bi bi-receipt"></i> Sales</a></li>
                <li><a href="customers.html"> <i class="bi bi-person-fill"></i> Customers</a></li>
                <li><a href="notifications.html"> <i class="bi bi-app-indicator"></i> Notifications</a></li>
                <li><a href="settings.html"> <i class="bi bi-sliders2"></i> Settings</a></li>
            </ul>
        </nav>
        <div class="logout-container">
            <a href="adminlogin.html" class="logout-button"> <i class="bi bi-box-arrow-right"></i> Log Out</a>
        </div>
    </aside>

    <main>
        <!--Notifications-->
        <h1>Notifications</h1>

    </main>
</body>
</html>