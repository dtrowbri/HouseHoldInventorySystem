<?php
namespace cst323;
session_start();
require_once 'header.php';
require_once 'Autoloader.php';
echo $message;

?>
	<div class="container">
		<div class="row mt-3 text-center">
			<h1>Welcome to the CST-323 HouseHold Inventory System!</h1>
			<h3>Milestone by Donald Trowbridge and Isaac Tucker</h3>
			<img class="rounded mx-auto d-block img-fluid" style="width: 60%; height: auto;" src="home-logo.png"></img>
		</div>
	</div>

<?php require_once 'footer.php'; ?>
