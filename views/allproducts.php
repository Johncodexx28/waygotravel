<?php 

  session_start();
  $pageTitle = "Bags - WayGo Travel";
  include '../views/includes/conn.php';

 
  if (!isset($_SESSION['email'])) {
      header("Location: ../index.php"); 
      exit(); 
  }

  $e = $_SESSION['email'];
  $fn = $_SESSION['full_name'];

?>

<!DOCTYPE html>
<html lang="en">

<?php include "../views/includes/head.php"; ?>
 
 
<body>

    <?php include '../views/includes/navbar.php'; ?>
    
    <main class="main">
      <section>

      
        <h1 class="text-center page-title">HEY USER THANK YOU FOR SIGNING UP !!</h1>
   
        <?php


          echo $e;
          echo $fn; 

        ?>

      </section>
    </main>

   

    <?php include '../views/includes/footer.php'; ?>

</body>
</html>
