<?php
session_start();
session_unset();
session_destroy();
echo "<script>
        alert('You have successfully logged out.');
        window.location.href='../admin/login.php';
      </script>";
exit();
