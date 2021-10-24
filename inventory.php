<?php
session_start();
require_once 'header.php';
echo $message;

//$db = new BusinessService();
//$results = $db->getAllInventory(Id);

include '_inventory.php';

require_once 'footer.php';
?>