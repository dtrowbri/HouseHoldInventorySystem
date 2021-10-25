<?php
session_start();
require_once 'header.php';
require_once 'business/services/inventoryService.php';
echo $message;

$db = new InventoryService();
$results = $db->getHouseHoldInventoryItems(1);

include '_inventory.php';

require_once 'footer.php';
?>