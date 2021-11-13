<?php
session_start();
require_once 'business/services/householdService.php';
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

if(isset($_POST['addHousehold'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $logger->debug("Entering household handler, add household:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'add',
        'name' => $name, 'address' => $address]);
    
    $db = new HouseHoldService(getDatabase());
    $household = new HouseHold($name, $address, getUserId());
    $success = $db->addHouseHold($household);
    if($success) {
        $logger->debug("Inside household handler, add household success:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'add',
        'name' => $name, 'address' => $address]);
        $message = "<div class='alert-success'>Household successfully added.</div>";
    } else {
        $logger->error("Inside household handler, add household failure:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'add',
            'name' => $name, 'address' => $address]);
        $message = "<div class='alert-danger'>Household registration failed.</div>";
    }
    include('households.php');
    
}

if(isset($_POST['HHEdit'])) {
    $input = $_POST['HHEdit']; //HHID
    $name = $_POST['name'];
    $address = $_POST['address'];
    
    $logger->debug("Entering household handler, edit household:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'edit',
        'input' => $input, 'name' => $name, 'address' => $address]);
    $household = new HouseHold($name, $address, getUserId());
    $household->setId($input);
    
    $db = new HouseHoldService(getDatabase());
    $success = $db->updateHouseHold($household);
    
    if($success) {
        $logger->debug("Inside household handler, edit household success:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'edit',
            'input' => $input, 'name' => $name, 'address' => $address]);
        $message = "<div class='alert-success'>Household successfully updated.</div>";
    } else {
        $logger->error("Inside household handler, edit household failure:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'edit',
            'input' => $input, 'name' => $name, 'address' => $address]);
        $message = "<div class='alert-danger'>Household edit failed.</div>";
    }
    include('households.php');
}

if(isset($_POST['HHDel'])) {
    $input = $_POST['HHDel'];
    $logger->debug("Entering household handler, delete household:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'delete',
        'input' => $input]);
    $db = new HouseHoldService(getDatabase());
    
    $success = $db->deleteHouseHold($input);
    
    if($success) {
        $logger->debug("Inside household handler, delete household success:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'delete',
            'input' => $input]);
        $message = "<div class='alert-success'>Household successfully deleted.</div>";
    } else {
        $logger->error("Inside household handler, delete household failure:", ['session' => session_id(), 'handler' => 'household', 'mode' => 'delete',
            'input' => $input]);
        $message = "<div class='alert-danger'>Household deletion failed.</div>";
    }
    include('households.php');
}

require_once 'footer.php'; 
?>