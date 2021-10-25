<?php

class AuthenticationService{
    
    
    function __construct(){
        
    }
    
    
    function authenticate(?string $UserId, ?string $password){
        
        //This is test code for the front-end testers. Will be replacing with code in later stages
        if($UserId == "test" && $password == "test"){
            return true;
        } else {
            return false;
        }
    }
}

?>