<?php
require_once 'business/models/inventoryitem.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class InventoryItemDAO {
    
    private $logger = null;
    
    public function __construct(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__. '/../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'construct']);
        $this->logger->info("Creating InventoryItemDAO", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'construct']);
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'construct']);
    }
    
    function addInventoryItem(?InventoryItem $InventoryItem, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'addInventoryItem']);
        $query = "insert into inventory (Id, Name, Quantity, HouseHoldId, Description) values (null, ?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $InventoryItem->getName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $InventoryItem->getQuantity(), PDO::PARAM_INT);
        $stmt->bindParam(3, $InventoryItem->getHouseHoldId(), PDO::PARAM_INT);
        $stmt->bindParam(4, $InventoryItem->getDescription(), PDO::PARAM_STR);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing the query to add an inventory item", ['session' => session_id(), 'InventoryItem' => $InventoryItem->getName(), 'HouseHoldId' => $InventoryItem->getHouseHoldId(), 'class' => 'InventoryItemDAO', 'method' => 'addInventoryItem']);
        }
        
        if($stmt->rowCount() == 1){
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'addInventoryItem']);
            return true;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'addInventoryItem']);
            return false;
        }
    }
    
    function deleteInventoryItem(?int $InventoryItemId, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'deleteInventoryItem']);
        $query = "delete from inventory where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $InventoryItemId, PDO::PARAM_INT);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing the query delete an inventory item", ['session' => session_id(), 'InventoryId' => $InventoryItemId, 'class' => 'InventoryItemDAO', 'method' => 'deleteInventoryItem']);   
        }
        
        if($stmt->rowCount() == 1){
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'deleteInventoryItem']);
            return true;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'deleteInventoryItem']);
            return false;
        }
    }
    
    function updateInventoryItem(?InventoryItem $InventoryItem, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'updateInventoryItem']);
        $query = "update inventory set Name = ?, Quantity = ?, Description = ? where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $InventoryItem->getName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $InventoryItem->getQuantity(), PDO::PARAM_INT);
        $stmt->bindParam(3, $InventoryItem->getDescription(), PDO::PARAM_STR);
        $stmt->bindParam(4, $InventoryItem->getId(), PDO::PARAM_INT);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing the query to update an inventory item", ['session' => session_id(), 'InventoryItemId' => $InventoryItem->getId(), 'class' => 'InventoryItemDAO', 'method' => 'updateInventoryItem']);    
        }
        
        if($stmt->rowCount() == 1){
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'updateInventoryItem']);
            return true;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'updateInventoryItem']);
            return false;
        }
    }
    
    function getInventoryItems(?int $HouseHoldId, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getInventoryItems']);
        $query = "select Id, Name, Quantity, HouseHoldId, Description from inventory where HouseHoldId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $HouseHoldId, PDO::PARAM_INT);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("There was an error executing the query to retrieve the list of inventory items for a household", ['session' => session_id(), 'HouseHoldId' => $HouseHoldId, 'class' => 'InventoryItemDAO', 'method' => 'getInventoryItems']);    
        }
        
        if($stmt->rowCount() > 0){
            $InventoryItems = array();
            $results = $stmt->fetchAll();
            
            foreach($results as $result){
                $InventoryItem = new InventoryItem($result['Name'], $result['Description'], $result['Quantity'], $result['HouseHoldId']);
                $InventoryItem->setId($result['Id']);
                array_push($InventoryItems, $InventoryItem);
            }
            
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getInventoryItems']);
            return $InventoryItems;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getInventoryItems']);
            return null;
        }
    }
    
    function getInventoryItem(?int $ItemID, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getInventoryItem']);
        $query = "select Id, Name, Quantity, HouseHoldId, Description from inventory where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $ItemID, PDO::PARAM_INT);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger-error("Error: There was an error executing the query to retrieve and inventory item", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'ItemId' => $ItemID, 'method' => 'getInventoryItem']);   
        }
        
        if($stmt->rowCount() > 0){
            $result = $stmt->fetchAll();
            $InventoryItem = new InventoryItem($result[0]['Name'], $result[0]['Description'], $result[0]['Quantity'], $result[0]['HouseHoldId']);
            $InventoryItem->setId($result[0]['Id']);

            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getInventoryItem']);
            return $InventoryItem;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'InventoryItemDAO', 'method' => 'getInventoryItem']);
            return null;
        }
    }
} 
?>