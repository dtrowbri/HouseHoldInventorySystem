<?php
require_once 'business/models/household.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Exception;

/**
 * HouseHoldDAO
 * Data Access Object for household related purposes.
 * Used by the household service.
 */
class HouseHoldDAO {
    
    /**
     * logger
     * Variable to hold logger instance.
     * @var Logger
     */
    private $logger = null;
        
    /**
     * __construct
     * create the household DAO.
     * @return void
     */
    public function __construct(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__. '/../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'construct']);
        $this->logger->info("Creating HouseHoldDAO", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'construct']);
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'construct']);
    }
        
    /**
     * addHouseHold
     * Store a household object into the database.
     * @param  HouseHold $HouseHold
     * @param  PDO $conn
     * @return bool
     */
    function addHouseHold(?HouseHold $HouseHold, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'addHouseHold']);
        $query = "insert into households (Id, Name, Address, UserId) values (null, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(1, $HouseHold->getName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $HouseHold->getAddress(), PDO::PARAM_STR);
        $stmt->bindParam(3, $HouseHold->getUserId(), PDO::PARAM_INT);
        
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
        
    /**
     * deleteHouseHold
     * Delete a household object from the database using the household ID.
     * @param  int $Id
     * @param  PDO $conn
     * @return bool
     */
    function deleteHouseHold(?int $Id, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'deleteHouseHold']);
        $query = "delete from households where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $Id, PDO::PARAM_INT);
        
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
        
    /**
     * getHouseHolds
     * Return all households for a given user id.
     * @param  int $UserId
     * @param  PDO $conn
     * @return array
     */
    function getHouseHolds(?int $UserId, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'getHouseHolds']);
        $query = "select Id, Name, Address, UserId from households where UserId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $UserId, PDO::PARAM_INT);
        
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
        
    /**
     * getHouseHold
     * Get specific household for provided household ID.
     * @param  int $HHID
     * @param  PDO $conn
     * @return HouseHold
     */
    function getHouseHold(?int $HHID, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'getHouseHold']);
        $query = "select Id, Name, Address, UserId from households where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $HHID, PDO::PARAM_INT);
        
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
        
    /**
     * updateHouseHold
     * Update household information in database with provided household object.
     * @param  HouseHold $HouseHold
     * @param  PDO $conn
     * @return bool
     */
    function updateHouseHold(?HouseHold $HouseHold, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldDAO', 'method' => 'updateHouseHold']);
        $query = "update households set Name = ?, Address = ? where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $HouseHold->getName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $HouseHold->getAddress(), PDO::PARAM_STR);
        $stmt->bindParam(3, $HouseHold->getId(), PDO::PARAM_INT);
        
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