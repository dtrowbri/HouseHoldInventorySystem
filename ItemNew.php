<?php
session_start();
require_once 'header.php';
if (!isset($_SESSION['USER_ID'])) {
    header('Location: login.php');
    exit;
}
?>
<div class="d-flex text-center bg-secondary">  
    <form class="form-login" action="ItemHandler.php" method="post">
        <img src="bootstrap-icons/icons/folder-plus.svg" class="mb-4" height="72" width="72" id="icon" alt="HH Icon" />
        <h1 class="h3 mb-3 font-weight-normal">Add New Item:</h1>
        <input type="text" id="name" name="name" class="form-control mb-2 ip-2" placeholder="Item Name" required autofocus />
        <input type="text" class="form-control mb-2" id="desc" name="desc" placeholder="Item Description" required />
        <input type="number" class="form-control mb-2" id="quantity" name="quantity" placeholder="Item Quantity" required />
        <button class="btn btn-lg btn-primary btn-block mb-2 mt-3" type="submit" id="addItem" name="addItem">Add Item</button>
        <button class="btn btn-lg btn-primary btn-block mb-2 mt-3" type="button" onclick="goBack()">Cancel</button>
    </form>
</div>
<script>
    function goBack()
    {
        location.href="inventory.php"
    };
</script>
<?php 
require_once 'footer.php';
?>