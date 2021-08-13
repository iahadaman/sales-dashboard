 <?php
session_start();
session_destroy();
header('location: ../sales-login.php');
?>