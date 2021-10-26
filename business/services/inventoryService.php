<?php

//require_once '../../database/database.php';
//require_once '../../database/inventoryitemdao.php';
//require_once '../models/inventoryitem.php';

class InventoryService {
    
    private $database;
    
    function __construct(){
        $this->database = new Database();
    }
    
    function addInventoryItem(?InventoryItem $InventoryItem){
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        
        $conn->beginTransaction();
        $results = $dao->addInventoryItem($InventoryItem, $conn);
        
        if($results){
            $conn->commit();
        } else {
            $conn->rollBack();
        }
        
        return $results;
    }
    
    function updateInventoryItem(?InventoryItem $InventoryItem){
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        
        $conn->beginTransaction();
        $results = $dao->updateInventoryItem($InventoryItem, $conn);
        
        if($results){
            $conn->commit();
        } else {
            $conn->rollBack();
        }
        
        return $results;
    }
    
    function deleteInventoryItem(?int $InventoryItemId){
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        
        $conn->beginTransaction();
        $results = $dao->deleteInventoryItem($InventoryItemId, $conn);
        
        if($results){
            $conn->commit();
        }else {
            $conn->rollBack();
        }
        return $results;
    }
    
    function getHouseHoldInventoryItems(?int $HouseHoldId){
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        $results = $dao->getInventoryItems($HouseHoldId, $conn);
        return $results;
    }
}

?>