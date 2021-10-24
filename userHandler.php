<?php
if(isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    echo "inside UserHandler with register " . $email . " " . $password . " " . $firstname . " " . $lastname;
}

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo "inside UserHandler with login " . $email . " " . $password;
}

?>