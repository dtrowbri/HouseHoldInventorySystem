<?php
namespace cst323;
require_once 'database/database.php';
require_once 'business/models/household.php';
require_once 'database/householddao.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * HouseHoldService
 * Service to handle household related requests.
 */
class HouseHoldService {
        
    /**
     * database
     * Variable to hold database instance.
     * @var IDatabase
     */
    private $database;    
    /**
     * logger
     * Variable to hold logger instance.
     * @var Logger
     */
    private $logger = null;

    /**
     * __construct
     * Construct the household service. 
     * @param  IDatabase $database
     * @return void
     */
    function __construct(?IDatabase $database){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__ . '/../../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'HouseHoldSevice', 'method' => 'construct']);
        $this->logger->debug("Creating HouseHoldService Service", ['session' => session_id(), 'class' => 'HouseHoldSevice', 'method' => 'construct']);
        $this->database = $database;
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'HouseHoldSevice', 'method' => 'construct']);
    }
        
    /**
     * addHouseHold
     * Add new household to the database.
     * @param  HouseHold $HouseHold
     * @return bool
     */
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
        
    /**
     * deleteHouseHold
     * Delete household from the database using household id.
     * @param  int $HouseHoldId
     * @return bool
     */
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
        
    /**
     * updateHouseHold
     * Update existing household information in database.
     * @param  HouseHold $HouseHold
     * @return bool
     */
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
        
    /**
     * getHouseHolds
     * return all households for a given user id.
     * @param  int $UserId
     * @return array
     */
    function getHouseHolds(?int $UserId){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'getHouseHolds']);
        $this->logger->info("Retrieving households", ['session' => session_id(), 'UserId' => $UserId, 'class' => 'HouseHoldService', 'method' => 'getHouseHolds']);
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->getHouseHolds($UserId, $conn);
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'HouseHoldService', 'method' => 'getHouseHolds']);
        return $results;
    }
        
    /**
     * getHouseHold
     * Return a specific household object for a given household id.
     * @param  int $HHID
     * @return HouseHold
     */
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
