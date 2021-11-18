<?php
require_once 'database/database.php';
require_once 'database/inventoryitemdao.php';
require_once 'business/models/inventoryitem.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * InventoryService
 * Service to handle inventory related requests.
 */
class InventoryService {
    
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
     * Construct the inventory service. 
     * @param  IDatabase $database
     * @return void
     */
    function __construct(?IDatabase $database){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__ . '/../../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'construct']);
        $this->logger->debug("Creating HouseHoldService Service", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'construct']);
        $this->database = $database;
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'construct']);
    }
        
    /**
     * addInventoryItem
     * Add the inventory item to the database.
     * @param  InventoryItem $InventoryItem
     * @return bool
     */
    function addInventoryItem(?InventoryItem $InventoryItem){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'addInventoryItem']);
        $this->logger->info("Adding Inventory Item", ['session' => session_id(), 'InventoryItem' => $InventoryItem->getName(), 'class' => 'InventoryService', 'method' => 'addInventoryItem']);
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        
        $conn->beginTransaction();
        $results = $dao->addInventoryItem($InventoryItem, $conn);
        if($results){
            $this->logger->info("Success: added inventory item", ['session' => session_id(), 'InventoryItem' => $InventoryItem->getName(), 'class' => 'InventoryService', 'method' => 'addInventoryItem']);
            $conn->commit();
        } else {
            $this->logger->error("Error: Failed to add inventory item", ['session' => session_id(), 'InventoryItem' => $InventoryItem->getName(), 'class' => 'InventoryService', 'method' => 'addInventoryItem']);
            $conn->rollBack();
        }
        
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'addInventoryItem']);
        return $results;
    }
        
    /**
     * updateInventoryItem
     * Update the existing invetory item within the database.
     * @param  InventoryItem $InventoryItem
     * @return bool
     */
    function updateInventoryItem(?InventoryItem $InventoryItem){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'updateInventoryItem']);
        $this->logger->info("Updating item", ['session' => session_id(), 'InventoryItem' => $InventoryItem->getId(), 'class' => 'InventoryService', 'method' => 'updateInventoryItem']);
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        
        $conn->beginTransaction();
        $results = $dao->updateInventoryItem($InventoryItem, $conn);
        
        if($results){
            $this->logger->info("Success: updated inventory item", ['session' => session_id(), 'InventoryItem' => $InventoryItem->getId(), 'class' => 'InventoryService', 'method' => 'updateInventoryItem']);
            $conn->commit();
        } else {
            $this->logger->error("Error: failed to update inventory item", ['session' => session_id(), 'InventoryItem' => $InventoryItem->getId(), 'class' => 'InventoryService', 'method' => 'updateInventoryItem']);
            $conn->rollBack();
        }
        
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'updateInventoryItem']);
        return $results;
    }
        
    /**
     * deleteInventoryItem
     * Delete the inventory item from the database.
     * @param  int $InventoryItemId
     * @return bool
     */
    function deleteInventoryItem(?int $InventoryItemId){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'deleteInventoryItem']);
        $this->logger->info("Deleting inventory item", ['session' => session_id(), 'InventoryItemId' => $InventoryItemId, 'class' => 'InventoryService', 'method' => 'deleteInventoryItem']);
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        
        $conn->beginTransaction();
        $results = $dao->deleteInventoryItem($InventoryItemId, $conn);
        
        if($results){
            $this->logger->info("Success: Inventory item deleted", ['session' => session_id(), 'InventoryItemId' => $InventoryItemId, 'class' => 'InventoryService', 'method' => 'deleteInventoryItem']);
            $conn->commit();
        }else {
            $this->logger->error("Error: Failed to delete inventory item", ['session' => session_id(), 'InventoryItemId' => $InventoryItemId, 'class' => 'InventoryService', 'method' => 'deleteInventoryItem']);
            $conn->rollBack();
        }
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'deleteInventoryItem']);
        return $results;
    }
        
    /**
     * getHouseHoldInventoryItems
     * Get all the items for a specific household id.
     * @param  int $HouseHoldId
     * @return array
     */
    function getHouseHoldInventoryItems(?int $HouseHoldId){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItems']);
        $this->logger->info("Retrieving inventory items for house hold", ['session' => session_id(), 'HouseHoldId' => $HouseHoldId, 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItems']);
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        $results = $dao->getInventoryItems($HouseHoldId, $conn);
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItems']);
        return $results;
    }
        
    /**
     * getHouseHoldInventoryItem
     * Return specific inventory item by item id.
     * @param  int $ItemID
     * @return InventoryItem
     */
    function getHouseHoldInventoryItem(?int $ItemID){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItem']);
        $this->logger->info("Retrieving HouseHold Item", ['session' => session_id(), 'ItemId' => $ItemId, 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItem']);
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        $results = $dao->getInventoryItem($ItemID, $conn);
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItem']);
        return $results;
    }
}

?>
