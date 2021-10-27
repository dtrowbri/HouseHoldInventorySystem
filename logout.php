 <?php
session_start();
$_SESSION = array();
session_destroy();
$message = "<div class='alert alert-success'>Logout Successful.</div>";
header('Location: index.php');
?>