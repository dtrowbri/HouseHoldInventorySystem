<?php
require_once 'business/models/inventoryitem.php';

class InventoryItemDAO {
    
    function addInventoryItem(?InventoryItem $InventoryItem, $conn){
        $query = "insert into inventory (Id, Name, Quantity, HouseHoldId, Description) values (null, ?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $InventoryItem->getName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $InventoryItem->getQuantity(), PDO::PARAM_INT);
        $stmt->bindParam(3, $InventoryItem->getHouseHoldId(), PDO::PARAM_INT);
        $stmt->bindParam(4, $InventoryItem->getDescription(), PDO::PARAM_STR);
        
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }
    
    function deleteInventoryItem(?int $InventoryItemId, $conn){
        $query = "delete from inventory where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $InventoryItemId, PDO::PARAM_INT);
        
        $stmt->execute();
        
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }
    
    function updateInventoryItem(?InventoryItem $InventoryItem, $conn){
        $query = "update inventory set Name = ?, Quantity = ?, Description = ? where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $InventoryItem->getName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $InventoryItem->getQuantity(), PDO::PARAM_INT);
        $stmt->bindParam(3, $InventoryItem->getDescription(), PDO::PARAM_STR);
        $stmt->bindParam(4, $InventoryItem->getId(), PDO::PARAM_INT);
        
        $stmt->execute();
        
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }
    
    function getInventoryItems(?int $HouseHoldId, $conn){
        $query = "select Id, Name, Quantity, HouseHoldId, Description from inventory where HouseHoldId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $HouseHoldId, PDO::PARAM_INT);
        
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $InventoryItems = array();
            $results = $stmt->fetchAll();
            
            foreach($results as $result){
                $InventoryItem = new InventoryItem($result['Name'], $result['Description'], $result['Quantity'], $result['HouseHoldId']);
                $InventoryItem->setId($result['Id']);
                array_push($InventoryItems, $InventoryItem);
            }
            //echo '<pre>' . print_r($InventoryItems) . '<pre>';
            return $InventoryItems;
        } else {
             return null;
        }
    }
}
?>