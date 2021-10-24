<?php


if(isset($_POST['addHousehold'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    echo "inside HHHandler with addHousehold " . $name . " " . $address;
}

if(isset($_POST['HHDel'])) {
    $input = $_POST['HHDel'];
    echo "inside HHHandler with HHDel";
}

?>