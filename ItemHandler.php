<?php
session_start();
require_once 'business/services/inventoryService.php';
require_once 'business/models/inventoryitem.php';
require_once 'session.php';
require_once 'Autoloader.php';

if (!isset($_SESSION['USER_ID'])) {
    header('Location: login.php');
    exit;
}

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler(__DIR__ . '/app.log', Logger::DEBUG));

if(isset($_POST['addItem'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];
    $hhid = getHHSelection();
    
    $logger->debug("Entering login handler, add item:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'add',
        'name' => $name, 'description' => $desc, 'quantity' => $quantity, 'household id' => $hhid]);
    //echo "inside ItemHandler with addItem " . $name . " " . $desc . " " . $quantity . " |" . $hhid . "<br>";
    
    $db = new InventoryService(getDatabase());
    $item = new InventoryItem($name, $desc, $quantity, $hhid);
    $success = $db->addInventoryItem($item);
    if($success) {    
        $logger->debug("Inside login handler, add item success:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'add',
        'name' => $name, 'description' => $desc, 'quantity' => $quantity, 'household id' => $hhid]);
        $message = "<div class='alert-success'>Item successfully added.</div>";
    } else {
        $logger->error("Inside login handler, add item failure:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'add',
            'name' => $name, 'description' => $desc, 'quantity' => $quantity, 'household id' => $hhid]);
        $message = "<div class='alert-danger'>Item registration failed.</div>";
    }
    include('inventory.php');
    
}

if(isset($_POST['ItemDel'])) {
    $input = $_POST['ItemDel'];
    $logger->debug("Inside login handler, delete item:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'delete',
        'input' => $input]);
    
    $db = new InventoryService(getDatabase());
    
    $success = $db->deleteInventoryItem($input);
    
    if($success) {
        $logger->debug("Inside login handler, delete item success:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'delete',
            'input' => $input]);
        $message = "<div class='alert-success'>Item successfully deleted.</div>";
    } else {
        $logger->error("Inside login handler, delete item failure:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'delete',
            'input' => $input]);
        $message = "<div class='alert-danger'>Item deletion failed.</div>";
    }
    include('inventory.php');
}


if(isset($_POST['ItemEdit'])) {
    $input = $_POST['ItemEdit'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];
    $hhid = getHHSelection();
    
    $logger->debug("Inside login handler, edit item:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'edit',
        'input' => $input, 'name' => $name, 'description' => $desc, 'quantity' => $quantity, "household id" => $hhid]);
    $db = new InventoryService(getDatabase());
    $item = new InventoryItem($name, $desc, $quantity, $hhid);

    $item->setId($input);
    
    $success = $db->updateInventoryItem($item);
    
    if($success) {
        $logger->debug("Inside login handler, edit item success:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'edit',
            'input' => $input, 'name' => $name, 'description' => $desc, 'quantity' => $quantity, "household id" => $hhid]);
        $message = "<div class='alert-success'>Item successfully updated.</div>";
    } else {
        $logger->error("Inside login handler, edit item failure:", ['session' => session_id(), 'handler' => 'item', 'mode' => 'edit',
            'input' => $input, 'name' => $name, 'description' => $desc, 'quantity' => $quantity, "household id" => $hhid]);
        $message = "<div class='alert-danger'>Item edit failed.</div>";
    }
    include('inventory.php');
}
require_once 'footer.php'; 

?>