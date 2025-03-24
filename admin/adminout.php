<?php
session_start();
session_unset();
session_destroy();
$_SESSION['message'] = "You have successfully logged out";
$_SESSION['type'] = "success";
header("Location: ../admin/login.php");
exit();
