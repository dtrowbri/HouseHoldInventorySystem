<?php
    function saveUser($user) {
        session_start();
        $_SESSION["USER"] = serialize($user);
    }
    
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
?>