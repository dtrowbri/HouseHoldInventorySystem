<?php
session_start();
require_once 'header.php';
require_once 'business/services/householdService.php';
require_once 'business/models/household.php';
if (!isset($_SESSION['USER_ID'])) {
    header('Location: login.php');
    exit;
}
$HHID = $_POST['HHEdit'];

$db = new HouseHoldService();
$household = $db->getHouseHold($HHID);
echo '
<div class="d-flex text-center bg-secondary">  
    <form class="form-login" action="HHHandler.php" method="post">
        <img src="bootstrap-icons/icons/house.svg" class="mb-4" height="72" width="72" id="icon" alt="HH Icon" />
        <h1 class="h3 mb-3 font-weight-normal">Edit Household:</h1>
        <input type="text" id="name" name="name" class="form-control mb-2 ip-2" placeholder="Household Name" value="'.$household->getName().'" required autofocus />
        <input type="text" class="form-control mb-2" id="address" name="address" placeholder="Household Address" value="'.$household->getAddress().'" required />
        <button class="btn btn-lg btn-primary btn-block mb-2 mt-3" type="submit" id="HHEdit" name="HHEdit" value="'.$household->getId().'">Save</button>
        <button class="btn btn-lg btn-primary btn-block mb-2 mt-3" type="button" onclick="goBack()">Cancel</button>
    </form>
</div>
<script>
    function goBack()
    {
        location.href="households.php"
    };
</script>';
require_once 'footer.php'; ?>