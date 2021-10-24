<?php


if(isset($_POST['addItem'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];
    echo "inside ItemHandler with addItem " . $name . " " . $desc . " " . $quantity;
}

if(isset($_POST['ItemDel'])) {
    $input = $_POST['ItemDel'];
    echo "inside ItemHandler with ItemDel";
}


if(isset($_POST['ItemEdit'])) {
    $input = $_POST['ItemEdit'];
    echo "inside ItemHandler with ItemEdit";
}

?>