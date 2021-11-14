<?php 
namespace cst323; 
require_once 'Autoloader.php'; 
?>
<html>
<head>
  <title>Household Inventory Manager</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script src="js/popper-lite.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">CST-323</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto form-inline">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a> 
          </li>
          <?php if (!isset($_SESSION['USER_ID'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="register.php">Register </a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="households.php">Households</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
          <?php endif; ?> 
        </ul>
      </div>
    </div>
  </nav>