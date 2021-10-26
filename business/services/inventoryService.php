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
        $results = $dao->addInventoryItem($InventoryItem, $conn);
        return $results;
    }
    
    function updateInventoryItem(?InventoryItem $InventoryItem){
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        $results = $dao->updateInventoryItem($InventoryItem, $conn);
        return $results;
    }
    
    function deleteInventoryItem(?int $InventoryItemId){
        $conn = $this->database->getConnection();
        $dao = new InventoryItemDAO();
        $results = $dao->deleteInventoryItem($InventoryItemId, $conn);
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