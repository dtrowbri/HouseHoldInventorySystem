<?php
session_start();
require_once 'header.php';
require_once 'business/services/householdService.php';
echo $message;

$db = new HouseHoldService();
$results = $db->getHouseHolds();

include '_households.php';

require_once 'footer.php';
?>