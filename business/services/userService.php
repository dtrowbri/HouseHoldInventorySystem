<?php


//require_once '../models/user.php';
//require_once '../../database/database.php';
//require_once '../../database/userdao.php';


class UserService {
    
    private $database;
    
    function __construct(){
        $this->database = new Database();
    }
    

    function AddUser(?User $user){
        $conn = $this->database->getConnection();
        $dao = new UserDAO();
        $isSuccessful = $dao->addUser($user, $conn);
        return $isSuccessful;
    }
}

?>