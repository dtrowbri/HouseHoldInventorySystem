<?php


//require_once '../models/user.php';
//require_once '../../database/database.php';
//require_once '../../database/userdao.php';


class UserService {
    
    private $database;
    
    function __construct(){
        $this->database = new Database();
    }
    
    function TestAddUser(?User $user){
        //This code is test code for the front-end user. Real code will be added later
        
        if($user->getEmail() != null && $user->getFirstName() != null && $user->getLastName() != null){
            return true;
        } else {
            return false;
        }
    }
    
    function AddUser(?User $user){
        $conn = $this->database->getConnection();
        $dao = new UserDAO();
        $isSuccessful = $dao->addUser($user, $conn);
        return $isSuccessful;
    }
}

?>