<?php
namespace cst323;
require_once 'business/models/household.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class HouseHoldDAO {
    
    private $logger = null;
    
    public function __construct(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__. '/../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'construct']);
        $this->logger->info("Creating HouseHoldDAO", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'construct']);
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'construct']);
    }
    
    function addHouseHold(?HouseHold $HouseHold, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'addHouseHold']);
        $query = "insert into households (Id, Name, Address, UserId) values (null, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(1, $HouseHold->getName(), \PDO::PARAM_STR);
        $stmt->bindParam(2, $HouseHold->getAddress(), \PDO::PARAM_STR);
        $stmt->bindParam(3, $HouseHold->getUserId(), \PDO::PARAM_INT);
        
        try{
        $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing the query to add a household", ['session' => session_id(), 'HouseHold' => $HouseHold, 'class' => 'HouseHoldDAO', 'method' => 'addHouseHold']);
        }
        
        if($stmt->rowCount() == 1){
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'addHouseHold']);
            return true;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'addHouseHold']);
            return false;
        }
    }
    
    function deleteHouseHold(?int $Id, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'deleteHouseHold']);
        $query = "delete from households where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $Id, \PDO::PARAM_INT);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing query to delete a household", ['session' => session_id(), 'HouseHoldID' => $Id, 'class' => 'HouseHoldDAO', 'method' => 'deleteHouseHold']);
        }
            
            
        if($stmt->rowCount() == 1){
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'deleteHouseHold']);
            return true;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'deleteHouseHold']);
            return false;
        }
    }
    
    function getHouseHolds(?int $UserId, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'getHouseHolds']);
        $query = "select Id, Name, Address, UserId from households where UserId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $UserId, \PDO::PARAM_INT);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing the query to retrieve household list", ['session' => session_id(), 'UserId' => $UserId, 'class' => 'HouseHoldDAO', 'method' => 'getHouseHolds']);  
        }
        
        if($stmt->rowCount() > 0){
            $households = array();
            $results = $stmt->fetchAll();
            
            foreach($results as $result){
                $household = new HouseHold($result["Name"], $result["Address"], $result["UserId"]);
                $household->setId($result["Id"]);
                array_push($households, $household);
            }
            
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'getHouseHolds']);
            return $households;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'getHouseHolds']);
            return null;
        }
    }
    
    function getHouseHold(?int $HHID, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'getHouseHold']);
        $query = "select Id, Name, Address, UserId from households where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $HHID, \PDO::PARAM_INT);
        
        try{
            $stmt->execute();
        } catch(Exception $e) {
            $this->logger->error("Error: There was an error executing the query to retrieve a household", ['session' => session_id(), 'HouseHoldId' => $HHID, 'class' => 'HouseHoldDAO', 'method' => 'getHouseHold']);  
        }
        
        if($stmt->rowCount() > 0){
            $result = $stmt->fetchAll();
            $household = new HouseHold($result[0]['Name'], $result[0]['Address'], $result[0]['UserId']);
            $household->setId($result[0]['Id']);
            
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'getHouseHold']);
            return $household;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'getHouseHold']);
            return null;
        }
    }
    
    function updateHouseHold(?HouseHold $HouseHold, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'updateHouseHold']);
        $query = "update households set Name = ?, Address = ? where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $HouseHold->getName(), \PDO::PARAM_STR);
        $stmt->bindParam(2, $HouseHold->getAddress(), \PDO::PARAM_STR);
        $stmt->bindParam(3, $HouseHold->getId(), \PDO::PARAM_INT);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing query to update the household", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'updateHouseHold'] );
        }
        
        if($stmt->rowCount() == 1){
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'updateHouseHold']);
            return true;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'updateHouseHold']);
            return false;
        }
    }
}
?>