<?php

class UserService {
    
    
    function __construct(){
        
    }
    
    function AddUser(?User $user){
        //This code is test code for the front-end user. Real code will be added later
        
        if($user->getEmail() != null && $user->getFirstName() != null && $user->getLastName() != null){
            return true;
        } else {
            return false;
        }
    }
}

?>