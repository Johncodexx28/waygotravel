<?php 

session_start();
include 'cart/cartoff.php';



include "assets/components/sweetalert.php";

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>WayGo Travel | Homepage</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

    <!-- Favicons -->
  <link rel="icon" href="https://scontent.fceb6-2.fna.fbcdn.net/v/t1.15752-9/476499417_617575271250819_1810467109142286150_n.png?_nc_cat=109&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFCTBv9lRrR6EMWD1pOMswkD5tjj-a7kn8Pm2OP5ruSf4dAQomlzdFbZmZ9yBhMK7ZTBMf2aCd_Bq1sHhu2SmPu&_nc_ohc=MqIi7pSTakgQ7kNvgFYNPcp&_nc_oc=AdgVD8roBWMMLecQRu0sPTjJdhYM15gSAVbVNvchvw24HHFNO_4819YL1vFrU2tGW0U&_nc_zt=23&_nc_ht=scontent.fceb6-2.fna&oh=03_Q7cD1wFWFnRUeKuXhON_Ek57akYtNxvOart6BA4_gC3lDMzCSA&oe=67FB3867">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    
  .nav-icon.cart {
  position: relative;
  display: inline-block;
}

.nav-icon.cart .badge {
  position: absolute;
  top: -8px;
  right: -8px;
  font-size: 0.75rem;
  padding: 0.25rem 0.5rem;
  border-radius: 50%;
}

  </style>
  

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="#carouselExampleAutoplaying" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">WayGo Travel</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#newrelease">New Release</a></li>
          <li><a href="views/bags.php">Bags</a></li>
          <li><a href="views/accessories.php">Accessories</a></li>
          <li><a href="views/apparel.php">Apparel</a></li>
          <li><a href="views/travel.php">Travel</a></li>
          <li><a href="views/about.php">About</a></li>
          <li><a href="views/contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    
      <div class="nav-icons-container d-flex align-items-end">
        <a class="nav-icon cart" href="#" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
          <i class="bi bi-cart"></i>
          <span class="badge bg-primary" id="cart-badge">0</span>
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
                  <a class="dropdown-item" href="../WayGo-Travel-Website/views/includes/logout.php">
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


  
  <main class="main">

  <?php include 'modal/logmodal.php' ?>
  <?php include 'modal/signmodal.php' ?>    

  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="views/bags.php"> <!-- Change this to your target link -->
          <img src="assets/img/x.jpg" class="d-block w-100 img-fluid" alt="...">
        </a>
      </div>
      <div class="carousel-item">
        <a href="views/bags.php"> <!-- Change this to your target link -->
          <img src="assets/img/carou_img2.png" class="d-block w-100 img-fluid" alt="...">
        </a>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


    <!-- Our Products Section -->
    <section id="ourproducts" class="menu section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Products</h2>
        <p><span>Shop By</span> <span class="description-title">Categories</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

          <li class="nav-item">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
              <h4>Bags</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
              <h4>Accessories</h4>
            </a><!-- End tab nav item -->

          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
              <h4>Apparel</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
              <h4>Travel</h4>
            </a>
          </li><!-- End tab nav item -->

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <div class="tab-pane fade active show" id="menu-starters">

            <div class="tab-header text-center">
              <h5><a href="../WayGo-Travel-Website/views/bags.php" class="shop-link-categories">Shop now &gt;</a></h5>
              <h3>Bags</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/bags/bag1.webp" class="glightbox"><img src="assets/img/bags/bag1.webp" class="menu-img img-fluid" alt=""></a>
                <p>Herschel Little America™ Backpack</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱10,990.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/bags/bag2.webp" class="glightbox"><img src="assets/img/bags/bag2.webp" class="menu-img img-fluid" alt=""></a>
                <p>Kaslo Backpack </p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱8,991.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/bags/bag3.webp" class="glightbox"><img src="assets/img/bags/bag3.webp" class="menu-img img-fluid" alt=""></a>
                <p>Thalia Crossbody</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱3,599.00
                </p>
              </div><!-- Menu Item -->
              
              <div class="col-lg-4 menu-item">
                <a href="assets/img/bags/bag4.webp" class="glightbox"><img src="assets/img/bags/bag4.webp" class="menu-img img-fluid" alt=""></a>
                <p>Herschel Novel™ Duffle</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>     
                <p class="price">
                  ₱7,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/bags/bag5.webp" class="glightbox"><img src="assets/img/bags/bag5.webp" class="menu-img img-fluid" alt=""></a>
                <p>Herschel Classic™ Hip Pack</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>   
                <p class="price">
                  ₱2,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/bags/bag6.webp" class="glightbox"><img src="assets/img/bags/bag6.webp" class="menu-img img-fluid" alt=""></a>
                <p>Pop Quiz 30 Pack Cooler</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>   
                <p class="price">
                  ₱4,599.00
                </p>
              </div><!-- Menu Item -->

            </div>
          </div><!-- End Starter Menu Content -->

          <div class="tab-pane fade" id="menu-breakfast">

            <div class="tab-header text-center">
              <h5><a href="../WayGo-Travel-Website/views/Accessories.php" class="shop-link-categories">Shop now &gt;</a></h5>
              <h3>Accessories</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/accessories/access1.webp" class="glightbox"><img src="assets/img/accessories/access1.webp" class="menu-img img-fluid" alt=""></a>
                <p>Chapter Travel Kit </p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/accessories/access2.webp" class="glightbox"><img src="assets/img/accessories/access2.webp" class="menu-img img-fluid" alt=""></a>
                <p>Tyler Wallet</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/accessories/access3.webp" class="glightbox"><img src="assets/img/accessories/access3.webp" class="menu-img img-fluid" alt=""></a>
                <p>Luggage Tag</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/accessories/access4.webp" class="glightbox"><img src="assets/img/accessories/access4.webp" class="menu-img img-fluid" alt=""></a>
                <p>Luggage Belt</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/accessories/access5.webp" class="glightbox"><img src="assets/img/accessories/access5.webp" class="menu-img img-fluid" alt=""></a>
                <p>Norman Stonewash Bucket Hat</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/accessories/access6.webp" class="glightbox"><img src="assets/img/accessories/access6.webp" class="menu-img img-fluid" alt=""></a>
                <p>Denman Sleeve</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

            </div>
          </div><!-- End Breakfast Menu Content -->

          <div class="tab-pane fade" id="menu-lunch">

            <div class="tab-header text-center">
              <h5><a href="../WayGo-Travel-Website/views/apparel.php" class="shop-link-categories">Shop now &gt;</a></h5>
              <h3>Apparel</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/apparel/apparel1.webp" class="glightbox"><img src="assets/img/apparel/apparel1.webp" class="menu-img img-fluid" alt=""></a>
                <p>Chapter Travel Kit </p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/apparel/apparel2.webp" class="glightbox"><img src="assets/img/apparel/apparel2.webp" class="menu-img img-fluid" alt=""></a>
                <p>Tyler Wallet</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/apparel/apparel3.webp" class="glightbox"><img src="assets/img/apparel/apparel3.webp" class="menu-img img-fluid" alt=""></a>
                <p>Luggage Tag</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/apparel/apparel4.webp" class="glightbox"><img src="assets/img/apparel/apparel4.webp" class="menu-img img-fluid" alt=""></a>
                <p>Luggage Belt</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/apparel/apparel5.webp" class="glightbox"><img src="assets/img/apparel/apparel5.webp" class="menu-img img-fluid" alt=""></a>
                <p>Norman Stonewash Bucket Hat</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/apparel/apparel6.webp" class="glightbox"><img src="assets/img/apparel/apparel6.webp" class="menu-img img-fluid" alt=""></a>
                <p>Denman Sleeve</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

            </div>
          </div><!-- End Lunch Menu Content -->

          <div class="tab-pane fade" id="menu-dinner">

            <div class="tab-header text-center">
              <h5><a href="../WayGo-Travel-Website/views/travel.php" class="shop-link-categories">Shop now &gt;</a></h5>
              <h3>Travel</h3>
            </div>


            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/travel/travel1.webp" class="glightbox"><img src="assets/img/travel/travel1.webp" class="menu-img img-fluid" alt=""></a>
                <p>Chapter Travel Kit </p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/travel/travel2.webp" class="glightbox"><img src="assets/img/travel/travel2.webp" class="menu-img img-fluid" alt=""></a>
                <p>Chapter Travel Kit </p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/travel/travel3.webp" class="glightbox"><img src="assets/img/travel/travel3.webp" class="menu-img img-fluid" alt=""></a>
                <p>Luggage Tag</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/travel/travel5.webp" class="glightbox"><img src="assets/img/travel/travel5.webp" class="menu-img img-fluid" alt=""></a>
                <p>Chapter Travel Kit </p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/travel/travel6.webp" class="glightbox"><img src="assets/img/travel/travel6.webp" class="menu-img img-fluid" alt=""></a>
                <p>Norman Stonewash Bucket Hat</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/travel/travel4.webp" class="glightbox"><img src="assets/img/travel/travel4.webp" class="menu-img img-fluid" alt=""></a>
                <p>Denman Sleeve</p>
                <p class="ratings">
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-fill text-warning"></i>  
                  <i class="bi bi-star-half text-warning"></i>  
                  (4.5/5)
                </p>                
                <p class="price">
                  ₱1,599.00
                </p>
              </div><!-- Menu Item -->

            </div>
          </div><!-- End Dinner Menu Content -->

        </div>

      </div>

    </section><!-- /Menu Section -->

    


    <section class="light-background">
    
    <div class="container py-5 " id="newrelease">
        <div class="row mb-2 text-center">
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <h2>New release</h2>
                  <p><span>GO-TO</span> <span class="description-title">TRAVEL-PACK</span></p>
                <h2 class="lead text-muted mx-auto" style="max-width: 500px;">
                    Designed for adventures, this pack offers ample space, durability,
                    and comfort for all your journeys ahead.
                </h2>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <!-- Left side features -->
            <div class="col-lg-3 col-md-6 order-lg-1 order-md-first">
                <div class="row g-4">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow-sm feature-card p-4">
                            <div class="feature-icon">
                                <i class="bi bi-arrows-fullscreen"></i>
                            </div>
                            <h5 class="fw-bold">SPACIOUS DESIGN</h5>
                            <p class="text-muted mb-0">Holds essentials and extras with simple organized space.</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm feature-card p-4">
                            <div class="feature-icon">
                                <i class="bi bi-cloud-rain"></i>
                            </div>
                            <h5 class="fw-bold">WEATHER RESISTANT</h5>
                            <p class="text-muted mb-0">Durable material keeps belongings safe in any weather.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Center image -->
            <div class="col-lg-6 col-md-12 order-lg-2 text-center my-lg-0 my-5">
                <img src="../WayGo-Travel-Website/assets/img/bags/addbag1.svg" alt="Go-To Travel Pack" class="img-fluid product-image">
            </div>
            
            <!-- Right side features -->
            <div class="col-lg-3 col-md-6 order-lg-3 order-md-last">
                <div class="row g-4">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow-sm feature-card p-4">
                            <div class="feature-icon">
                                <i class="bi bi-body-text"></i>
                            </div>
                            <h5 class="fw-bold">COMFORT FIT</h5>
                            <p class="text-muted mb-0">Padded straps offer all-day comfort and support.</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm feature-card p-4">
                            <div class="feature-icon">
                                <i class="bi bi-laptop"></i>
                            </div>
                            <h5 class="fw-bold">TECH-FRIENDLY</h5>
                            <p class="text-muted mb-0">Dedicated compartments protect laptops and electronic devices.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="#" class=" btn-sm px-5 py-3 fw-200 text-white rounded-5" style="background-color: #b10f0f">Shop now</a>
            </div>
        </div>

    </div>
  
    <!-- Travel Essentials Section -->
  <section id="chefs" class="chefs section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Travel Essentials</h2>
    <p><span>Our</span> <span class="description-title">Must-Have Travel Accessories<br></span></p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="team-member">
          <div class="member-img">
            <img src="assets/img/bags/luggagead.jpeg" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Luggage & Bags</h4>
            <span>Travel in Style</span>
            <p>Durable, lightweight luggage and versatile backpacks designed for hassle-free travel, whether it's a weekend escape or a global adventure.</p>
          </div>
        </div>
      </div><!-- End Team Member -->

      <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
        <div class="team-member">
          <div class="member-img">
            <img src="assets/img/travel/airportfit.jpeg" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Apparel</h4>
            <span>Comfort & Style</span>
            <p>Stay prepared for any climate with our selection of breathable, moisture-wicking clothing, packable jackets, and versatile travel wear.</p>
          </div>
        </div>
      </div><!-- End Team Member -->

      <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
        <div class="team-member">
          <div class="member-img">
            <img src="assets/img/travel/pillowneck.jpeg" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Comfort & Safety</h4>
            <span>Travel with Ease</span>
            <p>From neck pillows and eye masks to TSA-approved locks and RFID-blocking wallets, we provide comfort and security for stress-free journeys.</p>
          </div>
        </div>
      </div><!-- End Team Member -->

    </div>

  </div>

  </section><!-- /Travel Essentials Section -->


   

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p><span>Check</span> <span class="description-title">Our Gallery</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "centeredSlides": true,
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 0
                },
                "768": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 5,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery1.webp"><img src="assets/img/gallery/gallery1.webp" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery2.webp"><img src="assets/img/gallery/gallery2.webp" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery3.webp"><img src="assets/img/gallery/gallery3.webp" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery4.webp"><img src="assets/img/gallery/gallery4.webp" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery5.jpg"><img src="assets/img/gallery/gallery5.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery6.jpg"><img src="assets/img/gallery/gallery6.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery7.jpg"><img src="assets/img/gallery/gallery7.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery8.jpg"><img src="assets/img/gallery/gallery8.jpg" class="img-fluid" alt=""></a></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Gallery Section -->

    

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>A108 Baza, Streeet</p>
            <p>IloIlo City, Philippines</p>
            <p></p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>63+97528362911</span><br>
              <strong>Email:</strong> <span>waygotravel.co@gmail.com</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Mon-Sat:</strong> <span>11AM - 23PM</span><br>
              <strong>Sunday</strong>: <span>Closed</span>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Waygo Travel</strong> <span>All Rights Reserved</span></p>
      <p>Est.2025</p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>