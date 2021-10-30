<?php
require_once 'database/database.php';
    function saveUserId($id) {
        session_start();
        $_SESSION["USER_ID"] = $id;
    }

    function getUserId() {
        session_start();
        return $_SESSION["USER_ID"];
    }

    function saveUserName($fname, $lname) {
        session_start();
        $_SESSION["USERNAME"] = $fname . " " . $lname;
    }

    function getUserName() {
        session_start();
        return $_SESSION["USERNAME"];
    } 
    
    function saveHHSelection($id) {
        session_start();
        $_SESSION["HHID"] = $id;
    }
    
    function getHHSelection() {
        session_start();
        return $_SESSION["HHID"];
    }
    
    function getDatabase() {
        return new Database();
    }
?>