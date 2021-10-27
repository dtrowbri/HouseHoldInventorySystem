<?php
session_start();
require_once 'header.php';
require_once 'session.php';
require_once 'business/services/householdService.php';
if (!isset($_SESSION['USER_ID'])) {
    header('Location: login.php');
    exit;
}
echo $message;

$db = new HouseHoldService();
$results = $db->getHouseHolds(getUserId());

include '_households.php';

require_once 'footer.php';
?>