<?php
require_once 'business/services/inventoryService.php';
require_once 'business/models/inventoryitem.php';
require_once 'session.php';
session_start();
if (!isset($_SESSION['USER_ID'])) {
    header('Location: login.php');
    exit;
}
if(isset($_POST['addItem'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];
    $hhid = getHHSelection();
    //echo "inside ItemHandler with addItem " . $name . " " . $desc . " " . $quantity . " |" . $hhid . "<br>";
    
    $db = new InventoryService(getDatabase());
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
    $db = new InventoryService(getDatabase());
    
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
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];
    //echo "inside ItemHandler with ItemEdit";
    $db = new InventoryService(getDatabase());
    $item = new InventoryItem($name, $desc, $quantity, $hhid);

    $item->setId($input);
    
    $success = $db->updateInventoryItem($item);
    
    if($success) {
        $message = "<div class='alert-success'>Item successfully updated.</div>";
    } else {
        $message = "<div class='alert-danger'>Item edit failed.</div>";
    }
    include('inventory.php');
}
require_once 'footer.php'; 

?>