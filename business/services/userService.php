<?php
require_once 'database/database.php';
require_once 'business/models/user.php';
require_once 'database/userdao.php';

class UserService {
    
    private $database;
    
    function __construct(?IDatabase $database){
        $this->database = $database;
    }
    
    function AddUser(?User $user){
        $conn = $this->database->getConnection();
        $dao = new UserDAO();
        $isSuccessful = $dao->addUser($user, $conn);
        return $isSuccessful;
    }
    
    function GetUser(?string $email){
        $conn = $this->database->getConnection();
        $dao = new UserDAO();
        $user = $dao->getUser($email, $conn);
        return $user;
    }
}

?>