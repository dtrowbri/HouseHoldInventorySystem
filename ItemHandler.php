<?php
require_once 'business/services/inventoryService.php';
require_once 'session.php';

if(isset($_POST['addItem'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];
    $hhid = getHHSelection();
    //echo "inside ItemHandler with addItem " . $name . " " . $desc . " " . $quantity . " |" . $hhid . "<br>";
    
    $db = new InventoryService();
    $item = new InventoryItem($name, $desc, $quantity, $hhid);
    $success = $db->addInventoryItem($item);
    if($success) {
        $message = "<div class='alert-success'>Item successfully added.</div>";
    } else {
        $message = "<div class='alert-danger'>Item registration failed.</div>";
    }
    include('inventory.php');
    
}

if(isset($_POST['ItemDel'])) {
    $input = $_POST['ItemDel'];
    //echo "inside ItemHandler with ItemDel";
    $db = new InventoryService();
    
    $success = $db->deleteInventoryItem($input);
    
    if($success) {
        $message = "<div class='alert-success'>Item successfully deleted.</div>";
    } else {
        $message = "<div class='alert-danger'>Item deletion failed.</div>";
    }
    include('inventory.php');
}


if(isset($_POST['ItemEdit'])) {
    $input = $_POST['ItemEdit'];
    echo "inside ItemHandler with ItemEdit";
}

?>