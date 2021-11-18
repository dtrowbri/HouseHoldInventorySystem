<?php
require_once 'database/database.php';
    /**
     * saveUserId
     * Save user's ID to session.
     * @param  int $id
     * @return void
     */
    function saveUserId($id) {
        session_start();
        $_SESSION["USER_ID"] = $id;
    }
    
    /**
     * getUserId
     * Return sessino saved user id.
     * @return int
     */
    function getUserId() {
        session_start();
        return $_SESSION["USER_ID"];
    }
    
    /**
     * saveUserName
     * Save user first and last name to session as USERNAME
     * @param  string $fname
     * @param  string $lname
     * @return void
     */
    function saveUserName($fname, $lname) {
        session_start();
        $_SESSION["USERNAME"] = $fname . " " . $lname;
    }
    
    /**
     * getUserName
     * Return sessin saved username
     * @return string
     */
    function getUserName() {
        session_start();
        return $_SESSION["USERNAME"];
    } 
        
    /**
     * saveHHSelection
     * Save selected household to session. This is so after adding new items or editing existing items the application knows which household to refer the user.
     * @param  int $id
     * @return void
     */
    function saveHHSelection($id) {
        session_start();
        $_SESSION["HHID"] = $id;
    }
        
    /**
     * getHHSelection
     * return session saved household ID.
     * @return void
     */
    function getHHSelection() {
        session_start();
        return $_SESSION["HHID"];
    }
        
    /**
     * getDatabase
     * Create new instance of database. Creates central point where developer can change database objects.
     * @return Database
     */
    function getDatabase() {
        return new Database();
    }
?>