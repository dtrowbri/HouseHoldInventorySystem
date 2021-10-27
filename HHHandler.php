<?php
require_once 'business/services/householdService.php';
require_once 'session.php';
if (!isset($_SESSION['USER_ID'])) {
    header('Location: login.php');
    exit;
}
if(isset($_POST['addHousehold'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    //echo "inside HHHandler with addHousehold " . $name . " " . $address;
    
    $db = new HouseHoldService();
    $household = new HouseHold($name, $address, getUserId());
    $success = $db->addHouseHold($household);
    if($success) {
        $message = "<div class='alert-success'>Household successfully added.</div>";
    } else {
        $message = "<div class='alert-danger'>Household registration failed.</div>";
    }
    include('households.php');
    
}

if(isset($_POST['HHEdit'])) {
    $input = $_POST['HHEdit']; //HHID
    $name = $_POST['name'];
    $address = $_POST['address'];
    
    $household = new HouseHold($name, $address, getUserId());
    $household->setId($input);
    
    $db = new HouseHoldService();
    $success = $db->updateHouseHold($household);
    
    if($success) {
        $message = "<div class='alert-success'>Household successfully updated.</div>";
    } else {
        $message = "<div class='alert-danger'>Household edit failed.</div>";
    }
    include('households.php');
}

if(isset($_POST['HHDel'])) {
    $input = $_POST['HHDel'];
    //echo "inside HHHandler with HHDel" .$input ;
    $db = new HouseHoldService();
    
    $success = $db->deleteHouseHold($input);
    
    if($success) {
        $message = "<div class='alert-success'>Household successfully deleted.</div>";
    } else {
        $message = "<div class='alert-danger'>Household deletion failed.</div>";
    }
    include('households.php');
}

require_once 'footer.php'; 
?>