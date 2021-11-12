<?php
require_once 'database/database.php';
require_once 'business/models/user.php';
require_once 'database/userdao.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class UserService {
    
    private $database;
    
    function __construct(?IDatabase $database){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__ . '/../../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'UserService', 'method' => 'construct']);
        $this->logger->debug("Creating HouseHoldService Service", ['session' => session_id(), 'class' => 'UserService', 'method' => 'construct']);
        $this->database = $database;
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'UserService', 'method' => 'construct']);
    }
    
    function AddUser(?User $user){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'UserService', 'method' => 'AddUser']);
        $this->logger->info("Adding User", ['session' => session_id(), 'User' => $user, 'class' => 'UserService', 'method' => 'AddUser']);
        $conn = $this->database->getConnection();
        $dao = new UserDAO();
        $isSuccessful = $dao->addUser($user, $conn);
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'UserService', 'method' => 'AddUser']);
        return $isSuccessful;
    }
    
    function GetUser(?string $email){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'UserService', 'method' => 'GetUser']);
        $this->logger->info("Retrieving user", ['session' => session_id(), 'user' => $email, 'class' => 'UserService', 'method' => 'GetUser']);
        $conn = $this->database->getConnection();
        $dao = new UserDAO();
        $user = $dao->getUser($email, $conn);
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'UserService', 'method' => 'GetUser']);
        return $user;
    }
}

?>