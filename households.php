<?php
session_start();
require_once 'header.php';
echo $message;

//$db = new BusinessService();
//$results = $db->getAllHouseholds();

include '_households.php';

require_once 'footer.php';
?>