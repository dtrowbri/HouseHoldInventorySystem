<?php
//require_once './database.php';
//require_once '../business/models/user.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class UserDAO {
    
    private $logger = null;
    
    public function __construct(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__. '/../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'UserDAO', 'method' => 'construct']);
        $this->logger->info("Creating UserDAO", ['session' => session_id(), 'class' => 'UserDAO', 'method' => 'construct']);
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'UserDAO', 'method' => 'construct']);
    }
    
    function addUser(?User $user, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'addUser']);
        $query = "insert into users (Id, Email, Password, FirstName, LastName) values (null, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindValue(1, $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(3, $user->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(4, $user->getLastName(), PDO::PARAM_STR);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing the query to add a user", ['session' => session_id(), 'User' => $user->getEmail(), 'class' => 'InventoryItemDAO', 'method' => 'addUser']);
        }
        
        if($stmt->rowCount() == 1){
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'addUser']);
            return true;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'addUser']);
            return false;
        }
    }
    
    function getUser(?string $email, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getUser']);
        $query = "select Id, Email, FirstName, LastName from users where Email = ?";
        $stmt = $conn->prepare($query);
        
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing the query to retrieve user", ['session' => session_id(), 'user' => $email, 'class' => 'InventoryItemDAO', 'method' => 'getUser']);
        }
        
        if($stmt->rowCount() > 0){
            $result = $stmt->fetchAll();
            
            
            $user = new User($result[0]['Email'], $result[0]['FirstName'], $result[0]['LastName']);
            $user->setId($result[0]['Id']);
            
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getUser']);
            return $user;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getUser']);
            return null;
        }
    }
}

?>