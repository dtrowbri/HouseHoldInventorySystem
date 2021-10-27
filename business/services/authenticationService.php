<?php

require_once 'database/database.php';
require_once 'database/authenticationdao.php';

class AuthenticationService{
    
    private $database;
    
    function __construct(){
        $this->database = new Database();
    }
    
    function authenticate(?string $Email, ?string $Password){
        $conn = $this->database->getConnection();
        
        $dao = new AuthenticationDAO();
        
        //$Password = hash("sha512", $Password);  hasing on the handler so actual password is never used anywhere.
        $isSuccessful = $dao->authenticate($Email, $Password, $conn);
        
        return $isSuccessful;
    }
}

?>