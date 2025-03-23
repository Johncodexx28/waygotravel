<?php
session_start();
session_unset();
session_destroy();

$_SESSION['message'] = "Login failed.";
$_SESSION['type'] = "success";
?>
<script>
    window.location.href = "../../index.php";
</script>
<?php


exit();
