<?php
require_once 'database/database.php';
require_once 'business/models/household.php';
require_once 'database/householddao.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class HouseHoldService {
    
    private $database;
    private $logger = null;
    
    function __construct(?IDatabase $database){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__ . '/../../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'HouseHoldSevice', 'method' => 'construct']);
        $this->logger->debug("Creating HouseHoldService Service", ['session' => session_id(), 'class' => 'HouseHoldSevice', 'method' => 'construct']);
        $this->database = $database;
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'HouseHoldSevice', 'method' => 'construct']);
    }
    
    function addHouseHold(?HouseHold $HouseHold){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'addHouseHold']);
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $conn->beginTransaction();
        $results = $dao->addHouseHold($HouseHold, $conn);
        
        if($results){
            $this->logger->info("Success: Household added", ['session' => session_id(), 'Household' => $HouseHold, 'class' => 'HouseHoldService', 'method' => 'addHouseHold']);
            $conn->commit();
        } else {
            $this->logger->error("Error: Failed to add Household", ['session' => session_id(), 'Household' => $HouseHold, 'class' => 'HouseHoldService', 'method' => 'addHouseHold']);
            $conn->rollBack();
        }
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'addHouseHold']);
        return $results;
    }
    
    function deleteHouseHold(?int $HouseHoldId){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'deleteHouseHold']);
        $this->logger->info("Deleting household", ['session' => session_id(), 'HouseHoldId' => $HouseHoldId, 'class' => 'HouseHoldService', 'method' => 'deleteHouseHold']);
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $conn->beginTransaction();
        $results = $dao->deleteHouseHold($HouseHoldId, $conn);
        
        if($results){
            $this->logger->info("Success: Household deleted", ['session' => session_id(), 'HouseHoldId' => $HouseHoldId, 'class' => 'HouseHoldService', 'method' => 'deleteHouseHold']);
            $conn->commit();
        } else {
            $this->logger->error("Error: Failed to delete HouseHold", ['session' => session_id(), 'HouseHoldId' => $HouseHoldId, 'class' => 'HouseHoldService', 'method' => 'deleteHouseHold']);
            $conn->rollBack();
        }
        
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'deleteHouseHold']);
        return $results;
    }
    
    function updateHouseHold(?HouseHold $HouseHold){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'updateHouseHold']);
        $this->logger->info("Updating HouseHold", ['session' => session_id(), 'HouseHold' => $HouseHold, 'class' => 'HouseHoldService', 'method' => 'updateHouseHold']);
        $conn = $this->database->getConnection();
        
        $dao = new HouseHoldDAO();
        $conn->beginTransaction();
        
        $results = $dao->updateHouseHold($HouseHold, $conn);
        
        if($results){
            $this->logger->info("Success: Updated household", ['session' => session_id(), 'HouseHold' => $HouseHold, 'class' => 'HouseHoldService', 'method' => 'updateHouseHold']);
            $conn->commit();
        } else {
            $this->logger->error("Error: Failed to updated household", ['session' => session_id(), 'HouseHold' => $HouseHold, 'class' => 'HouseHoldService', 'method' => 'updateHouseHold']);
            $conn->rollBack();
        }
        
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'udpateHouseHold']);
        return $results;
    }
    
    function getHouseHolds(?int $UserId){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'getHouseHolds']);
        $this->logger->info("Retrieving households", ['session' => session_id(), 'UserId' => $UserId, 'class' => 'HouseHoldService', 'method' => 'getHouseHolds']);
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->getHouseHolds($UserId, $conn);
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'getHouseHolds']);
        return $results;
    }
    
    function getHouseHold(?int $HHID){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'getHouseHold']);
        $this->logger->info("Retrieving household", ['session' => session_id(), 'HouseHoldId' => $HHID, 'class' => 'HouseHoldService', 'method' => 'getHouseHold']);
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->getHouseHold($HHID, $conn);
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'getHouseHold']);
        return $results;
    }
}

?>
