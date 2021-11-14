<?php
namespace cst323;
require_once 'database/database.php';
require_once 'database/inventoryitemdao.php';
require_once 'business/models/inventoryitem.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class InventoryService {
    
    private $database;
    private $logger = null;
    
    function __construct(?IDatabase $database){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__ . '/../../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'construct']);
        $this->logger->debug("Creating HouseHoldService Service", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'construct']);
        $this->database = $database;
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'construct']);
    }
    
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
    
    function getHouseHoldInventoryItems(?int $HouseHoldId){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItems']);
        $this->logger->info("Retrieving inventory items for house hold", ['session' => session_id(), 'HouseHoldId' => $HouseHoldId, 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItems']);
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        $results = $dao->getInventoryItems($HouseHoldId, $conn);
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryService', 'method' => 'getHouseHoldInventoryItems']);
        return $results;
    }
    
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
