<?php 
   session_start();
   $pageTitle = "Accessories - WayGo Travel";


   include '../views/includes/conn.php';
   include '../cart/getcartcount.php';
   


   

   $get_products = "SELECT products.*, categories.category_name 
   FROM products 
   INNER JOIN categories ON products.category_id = categories.category_id
   WHERE categories.category_name = 'Accessories'
   ORDER BY products.created_at DESC
   LIMIT 8";

   $result = $conn->query($get_products);





?>
<!DOCTYPE html>
<html lang="en">
   <?php include "../views/includes/head.php"; ?>
   <body>
      <?php include '../views/includes/navbar.php'; ?>
      <?php include "../assets/components/sweetalert.php"; ?>

      
      <main class="main">
         <?php include '../modal/logmodal.php' ?>
         <?php include '../modal/signmodal.php' ?>  
         <section id="hero" class="hero section " style="background-position: center; background-image:url(../assets/img/banneraccess.png)" >
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
                  
                  <div class="row row-cols-1 row-cols-md-4 row-cols-lg- g-4 mb-4">
                     <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="col">
                              <a href="../views/productdetails.php?id=<?php echo $row['product_id']; ?>" class="text-decoration-none">
                                 <div class="product-card position-relative">
                                          <?php if ($row['discount'] > 0): ?>
                                             <div class="sale-badge"><?php echo htmlspecialchars($row['discount']); ?>% off</div>
                                          <?php endif; ?>
                                          <div class="stock-badge"><?php echo htmlspecialchars($row['stock']); ?> in stock</div>
                                    <div class="text-center p-3 ">
                                          <img src="../<?php echo htmlspecialchars($row['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($row['name']); ?>" 
                                             class="img-fluid">
                                    </div>
                                    <div class="color-options text-center mb-2">
                                       <span class="color-option" style="background-color: #8B4513;"></span>
                                       <span class="color-option" style="background-color: #000000;"></span>
                                       <span class="color-option" style="background-color: #333333;"></span>
                                       <span class="color-option" style="background-color: #696969;"></span>
                                    </div>
                                    <div class="p-3">
                                          <h3 class="product-title"><?php echo htmlspecialchars($row['name']); ?></h3>
                                          <div class="d-flex">
                                             <div class="product-price">₱<?php echo number_format($row['price'], 2); ?></div>
                                             <?php if (!empty($row['sale_price'])) { ?>
                                                <div class="sale-price">₱<?php echo number_format($row['sale_price'], 2); ?></div>
                                             <?php } ?>
                                          </div>
                                    </div>
                                 </div>
                              </a>
                        </div>
                     <?php } ?>
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
      <?php include '../cart/fetchcart.php'?>
      <?php include '../cart/cartoff.php' ?>
   </body>
</html>