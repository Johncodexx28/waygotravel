<?php 
   $pageTitle = "New Release - WayGo Travel";
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <?php include "../views/includes/head.php"; ?>
   <body>
      <?php include '../views/includes/navbar.php'; ?>
      <main class="main">
         <?php include '../modal/logmodal.php' ?>
         <?php include '../modal/signmodal.php' ?>  
         <section id="hero" class="hero section " style="background-position: center; background-image:url(../assets/img/newrelease.jpg)" >
            <div class="container">
            </div>
         </section>
         <div class="container-fluid py-4">
            <div class="row">
               <!-- Filter Sidebar -->
               <div class="col-lg-3 filter-sidebar p-5 pt-0">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <div>
                        <i class="bi bi-funnel"></i> Filter
                     </div>
                     <div>
                        <i class="bi bi-chevron-left"></i>
                     </div>
                  </div>
                  <!-- Out of Stock Filter -->
                  <div class="mb-4">
                     <div class="filter-heading">
                        Out of stock
                     </div>
                     <div class="filter-content">
                        <button class="btn btn-sm btn-outline-secondary me-2">Show</button>
                        <button class="btn btn-sm btn-light">Hide</button>
                     </div>
                  </div>
                  <!-- Price Filter -->
                  <div class="mb-4">
                     <div class="filter-heading d-flex justify-content-between">
                        Price
                        <i class="bi bi-chevron-up"></i>
                     </div>
                     <div class="filter-content">
                        <div class="row">
                           <div class="col-6">
                              <input type="text" class="form-control" placeholder="₱0">
                           </div>
                           <div class="col-6">
                              <input type="text" class="form-control" placeholder="₱10791">
                           </div>
                        </div>
                        <div class="price-range-slider mt-3">
                           <div class="slider-track"></div>
                           <div class="slider-handle"></div>
                           <div class="slider-handle"></div>
                        </div>
                     </div>
                  </div>
                  <!-- Product Type Filter - Using Grid System -->
                  <div class="mb-4">
                     <div class="filter-heading d-flex justify-content-between">
                        Product type
                        <i class="bi bi-chevron-up"></i>
                     </div>
                     <div class="filter-content">
                        <div class="row row-cols-2">
                           <!-- Using 2 columns grid -->
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="backpacks">
                                 <label class="form-check-label" for="backpacks">
                                 Backpacks
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="crossbodies">
                                 <label class="form-check-label" for="crossbodies">
                                 Crossbodies
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="dufflebags">
                                 <label class="form-check-label" for="dufflebags">
                                 Duffle Bags
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="duffles">
                                 <label class="form-check-label" for="duffles">
                                 Duffles
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="hippacks">
                                 <label class="form-check-label" for="hippacks">
                                 Hip packs
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="hipPacks">
                                 <label class="form-check-label" for="hipPacks">
                                 Hip Packs
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="insulated">
                                 <label class="form-check-label" for="insulated">
                                 Insulated
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="premiumClassics">
                                 <label class="form-check-label" for="premiumClassics">
                                 Premium Classics
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="tote">
                                 <label class="form-check-label" for="tote">
                                 Tote
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="toteBags">
                                 <label class="form-check-label" for="toteBags">
                                 Tote Bags
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="trolleySleeve">
                                 <label class="form-check-label" for="trolleySleeve">
                                 Trolley Sleeve
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Product Listing -->
               <div class="col-lg-9 p-5 pt-0">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                     <div>384 products</div>
                     <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Best selling
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                           <li><a class="dropdown-item" href="#">Best selling</a></li>
                           <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                           <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                           <li><a class="dropdown-item" href="#">Newest</a></li>
                        </ul>
                     </div>
                  </div>
                  <!-- Products Grid - First Row -->
                  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
                     <!-- Product 1 -->
                     <div class="col">
                        <a href="../views/productdetails.php" class="text-decoration-none">
                            <div class="product-card position-relative">
                            <div class="sale-badge">10% off</div>
                            <div class="text-center p-3">
                                <img src="../assets/img/bags/bag1.webp" alt="Herschel Backpack Black" class="img-fluid">
                            </div>
                            <div class="color-options text-center mb-2">
                                <span class="color-option" style="background-color: #8B4513;"></span>
                                <span class="color-option" style="background-color: #000000;"></span>
                                <span class="color-option" style="background-color: #333333;"></span>
                                <span class="color-option" style="background-color: #696969;"></span>
                            </div>
                            <div class="p-3">
                                <h5 class="product-title">Herschel Little America™ Backpack | Premium Classics - 30L</h5>
                                <div class="d-flex">
                                    <div class="product-price">₱10,791.00</div>
                                    <div class="sale-price">Sale</div>
                                </div>
                            </div>
                            </div>
                        </a>
                     </div>
                     <!-- Product 2 -->
                     <div class="col">
                        <div class="product-card position-relative">
                           <div class="sale-badge">10% off</div>
                           <div class="stock-badge">3 in stock</div>
                           <div class="text-center p-3">
                              <img src="../assets/img/bags/bag2.webp"alt="Herschel Backpack Black Tan" class="img-fluid">
                           </div>
                           <div class="color-options text-center mb-2">
                              <span class="color-option" style="background-color: #000080;"></span>
                              <span class="color-option" style="background-color: #ADD8E6;"></span>
                              <span class="color-option" style="background-color: #191970;"></span>
                              <span class="color-option" style="background-color: #8B4513;"></span>
                           </div>
                           <div class="p-3">
                              <h5 class="product-title">Herschel Little America™ Backpack | Mid-Volume - 20L</h5>
                              <div class="d-flex">
                                 <div class="product-price">₱7,191.00</div>
                                 <div class="sale-price">Sale</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Product 3 -->
                     <div class="col">
                        <div class="product-card position-relative">
                           <div class="sale-badge">10% off</div>
                           <div class="text-center p-3">
                              <img src="../assets/img/bags/bag3.webp" alt="Herschel Backpack Gray" class="img-fluid">
                           </div>
                           <div class="color-options text-center mb-2">
                              <span class="color-option" style="background-color: #000000;"></span>
                              <span class="color-option" style="background-color: #696969;"></span>
                              <span class="color-option" style="background-color: #333333;"></span>
                              <span class="color-option" style="background-color: #4B0082;"></span>
                           </div>
                           <div class="p-3">
                              <h5 class="product-title">Herschel Little America™ Backpack - 30L</h5>
                              <div class="d-flex">
                                 <div class="product-price">₱7,641.00</div>
                                 <div class="sale-price">Sale</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Product 4 -->
                     <div class="col">
                        <div class="product-card position-relative">
                           <div class="sale-badge">10% off</div>
                           <div class="text-center p-3">
                              <img src="../assets/img/bags/bag4.webp"alt="Herschel Backpack Pink" class="img-fluid">
                           </div>
                           <div class="color-options text-center mb-2">
                              <span class="color-option" style="background-color: #8B4513;"></span>
                              <span class="color-option" style="background-color: #FF1493;"></span>
                              <span class="color-option" style="background-color: #000000;"></span>
                              <span class="color-option" style="background-color: #D3D3D3;"></span>
                           </div>
                           <div class="p-3">
                              <h5 class="product-title">Herschel Little America™ Backpack - 30L</h5>
                              <div class="d-flex">
                                 <div class="product-price">₱7,641.00</div>
                                 <div class="sale-price">Sale</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Products Grid - Second Row -->
                  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                     <!-- Product 5 -->
                     <div class="col">
                        <div class="product-card position-relative">
                           <div class="sale-badge">10% off</div>
                           <div class="text-center p-3">
                              <img src="../assets/img/bags/bag5.webp" alt="Herschel Backpack Black" class="img-fluid">
                           </div>
                           <div class="p-3">
                              <h5 class="product-title">Herschel Backpack - Slim Profile</h5>
                              <div class="d-flex">
                                 <div class="product-price">₱6,541.00</div>
                                 <div class="sale-price">Sale</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Product 6 -->
                     <div class="col">
                        <div class="product-card position-relative">
                           <div class="sale-badge">10% off</div>
                           <div class="stock-badge">1 in stock</div>
                           <div class="text-center p-3">
                              <img src="../assets/img/bags/bag6.webp" alt="Herschel Backpack Black Leather" class="img-fluid">
                           </div>
                           <div class="p-3">
                              <h5 class="product-title">Herschel Premium Leather Backpack</h5>
                              <div class="d-flex">
                                 <div class="product-price">₱12,991.00</div>
                                 <div class="sale-price">Sale</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Product 7 -->
                     <div class="col">
                        <div class="product-card position-relative">
                           <div class="sale-badge">10% off</div>
                           <div class="text-center p-3">
                              <img src="../assets/img/bags/bag1.webp" alt="Herschel Urban Backpack" class="img-fluid">
                           </div>
                           <div class="p-3">
                              <h5 class="product-title">Herschel Urban Commuter Backpack</h5>
                              <div class="d-flex">
                                 <div class="product-price">₱8,541.00</div>
                                 <div class="sale-price">Sale</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Product 8 -->
                     <div class="col">
                        <div class="product-card position-relative">
                           <div class="sale-badge">10% off</div>
                           <div class="text-center p-3">
                              <img src="../assets/img/bags/bag2.webp" alt="Herschel Backpack Pink" class="img-fluid">
                           </div>
                           <div class="p-3">
                              <h5 class="product-title">Herschel Travel Daypack - Compact</h5>
                              <div class="d-flex">
                                 <div class="product-price">₱5,641.00</div>
                                 <div class="sale-price">Sale</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Pagination -->
                  <div class="d-flex justify-content-center mt-5">
                     <nav aria-label="Product pagination">
                        <ul class="pagination">
                           <li class="page-item">
                              <a class="page-link" href="#" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              </a>
                           </li>
                           <li class="page-item active"><a class="page-link" href="#">1</a></li>
                           <li class="page-item"><a class="page-link" href="#">2</a></li>
                           <li class="page-item"><a class="page-link" href="#">3</a></li>
                           <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              </a>
                           </li>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <?php include '../views/includes/footer.php'; ?>
   </body>
</html>