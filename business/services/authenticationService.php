<?php

//require_once '../../database/database.php';
//require_once '../../database/authenticationdao.php';

class AuthenticationService{
    
    private $database;
    
    function __construct(){
        $this->database = new Database();
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