<?php
$current_page = basename($_SERVER['PHP_SELF']); // Get current file name
?>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="../index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">WayGo Travel</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
          <ul>
              <li><a href="newrelease.php">New Release</a></li>
              <li><a href="bags.php" class="<?= ($current_page == 'bags.php') ? 'active' : '' ?>">Bags</a></li>
              <li><a href="accessories.php" class="<?= ($current_page == 'accessories.php') ? 'active' : '' ?>">Accessories</a></li>
              <li><a href="apparel.php" class="<?= ($current_page == 'apparel.php') ? 'active' : '' ?>">Apparel</a></li>
              <li><a href="travel.php" class="<?= ($current_page == 'travel.php') ? 'active' : '' ?>">Travel</a></li>
              <li><a href="about.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">About</a></li>
              <li><a href="contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>">Contact</a></li>
          </ul>
      </nav>

      <div class="nav-icons-container d-flex align-items-end">
        <!-- Cart Icon Triggers Offcanvas -->
        <a class="nav-icon cart" href="#" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
          <i class="bi bi-cart"></i>
        </a>

        <div class="user-prof-drop">
            <a class="nav-icon user dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
              <?php if(isset($_SESSION['user_id'])): ?>
                <li>
                  <a class="dropdown-item" href="profile.php">
                    <i class="bi bi-person me-2"></i> My Profile
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="settings.php">
                    <i class="bi bi-gear me-2"></i> Settings
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="../views/includes/logout.php">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                  </a>
                </li>
              <?php else: ?>
                <li>
                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Login
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">
                    <i class="bi bi-person-plus me-2"></i> Signup
                  </a>
                </li>
              <?php endif; ?>
            </ul>
        </div>      
      </div>  
    </div>
</header>
<?php include 'cartoff.php' ?>

