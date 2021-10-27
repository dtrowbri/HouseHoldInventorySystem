<?php
session_start();
require_once 'header.php';
require_once 'business/services/inventoryService.php';
require_once 'business/models/inventoryitem.php';
if (!isset($_SESSION['USER_ID'])) {
    header('Location: login.php');
    exit;
}
$HHID = $_POST['ItemEdit'];

$db = new InventoryService();
$item = $db->getHouseHoldInventoryItem($HHID);
echo '
<div class="d-flex text-center bg-secondary">  
    <form class="form-login" action="ItemHandler.php" method="post">
        <img src="bootstrap-icons/icons/folder-plus.svg" class="mb-4" height="72" width="72" id="icon" alt="HH Icon" />
        <h1 class="h3 mb-3 font-weight-normal">Edit Item:</h1>
        <input type="text" id="name" name="name" class="form-control mb-2 ip-2" placeholder="Item Name" value="'.$item->getName().'" required autofocus />
        <input type="text" class="form-control mb-2" id="desc" name="desc" placeholder="Item Description" value="'.$item->getDescription().'" required />
        <input type="number" class="form-control mb-2" id="quantity" name="quantity" placeholder="Item Quantity" value="'.$item->getQuantity().'" required />
        <button class="btn btn-lg btn-primary btn-block mb-2 mt-3" type="submit" id="ItemEdit" name="ItemEdit" value="'.$item->getId().'">Save</button>
        <button class="btn btn-lg btn-primary btn-block mb-2 mt-3" type="button" onclick="goBack()">Cancel</button>
    </form>
</div>
<script>
    function goBack()
    {
        location.href="inventory.php"
    };
</script>';
require_once 'footer.php';
?>