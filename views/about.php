<?php 
  $pageTitle = "About - WayGo Travel";
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../views/includes/head.php"  ?>
<body>

  <?php include '../views/includes/navbar.php'; ?>
  
  
  <main class="main">

      <?php include '../modal/logmodal.php' ?>
      <?php include '../modal/signmodal.php' ?>  


      <section id="about" class="about section">
        <div class="container section-title" data-aos="fade-up">
            <h2>About Us<br></h2>
            <p><span>Learn More</span> <span class="description-title">About Us</span></p>
        </div> <!-- Closing div properly -->

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                    <img src="../assets/img/about.jpg" class="img-fluid mb-4" alt="">
                </div>
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                        At WayGo Travel, we provide high-quality,functional,and innovative travel accessories that enchance your travel experience.
                    </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> <span> Durable luggage Orgsnizers</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span> Tech-friendly travel gear</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span> Compact and funcational accessories</span></li>
                        </ul>
                        <p>
                            We are passionate about making travel easier,so you can focus on creating unforgettable memories.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="why-us" class="why-us section light-background">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-box">
                        <h3>Why Choose WayGo Travel</h3>
                        <p>
                        Premium travel gear designed for Durability, Style, and comfort.
                        </p>
                        <div class="text-center">
                            <a href="#" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div> <!-- End Why Box -->

                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-xl-4">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-star"></i>
                                <h4>Premium Quality</h4>
                                <p>Design for long-lasting durability and style.</p>
                            </div>
                        </div> <!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-gem"></i>
                                <h4>Affordable Prices</h4>
                                <p> Get the best value with competitive pricing.</p>
                            </div>
                        </div>

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-box"></i>
                                <h4>Fast & Secure Shipping</h4>
                                <p> We secure timely delivery worldwide</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- End col-lg-8 -->
            </div>
        </div>
    </section>
    </main>



  <?php include '../views/includes/footer.php'; ?>
</body>
</html>