<?php

//require_once '../../database/database.php';
//require_once '../../database/authenticationdao.php';

class AuthenticationService{
    
    private $database;
    
    function __construct(){
        $this->database = new Database();
    }
    
    
    function TestAuthenticate(?string $UserId, ?string $password){
        
        //This is test code for the front-end testers. Will be replacing with code in later stages
        if($UserId == "test" && $password == "test"){
            return true;
        } else {
            return false;
        }
    }
    
    function authenticate(?int $UserId, ?string $Password){
        $conn = $this->database->getConnection();
        $dao = new AuthenticationDAO();
        
        $Password = hash("sha512", $Password);
        $isSuccessful = $dao->authenticate($UserId, $Password, $conn);
        return $isSuccessful;
    }
}

?>