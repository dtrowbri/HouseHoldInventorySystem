<?php
session_start();
require_once 'header.php';
require_once 'business/services/inventoryService.php';
require_once 'session.php';
echo $message;
if($_POST['inventory'] != null) { saveHHSelection($_POST['inventory']); }

$db = new InventoryService();
$results = $db->getHouseHoldInventoryItems(getHHSelection());

include '_inventory.php';

require_once 'footer.php';
?>