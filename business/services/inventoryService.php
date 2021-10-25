<?php

class InventoryService {
    
    function __construct(){
        
    }
    
    function addInventoryItem(?InventoryItem $InventoryItem){
        //This code is test code for the front-end user. Real code will be added later
        if($InventoryItem->getDescription() != null && $InventoryItem->getHouseHoldId() != null && $InventoryItem->getName() != null && $InventoryItem->getQuantity() != null){
            return true;
        } else {
            return false;
        }
    }
    
    function updateInventoryItem(?InventoryItem $InventoryItem){
        //This code is test code for the front-end user. Real code will be added later
        return true;
    }
    
    function deleteInventoryItem(?InventoryItem $InventoryItem){
        //This code is test code for the front-end user. Real code will be added later
        return true;
    }
    
    function getHouseHoldInventoryItems(?int $HouseHold){
        //This code is test code for the front-end user. Real code will be added later
        $InventoryItems = array();
        $InventoryItem1 = new InventoryItem("Sponge", "Sponge with brillo pad", 2, 1);
        $InventoryItem1->setId(1);
        $InventoryItem2 = new InventoryItem("Bleach", "Bottle of Bleach - 32oz", 1, 1);
        $InventoryItem2->setId(2);
        
        array_push($InventoryItems, $InventoryItem1);
        array_push($InventoryItems, $InventoryItem2);
        
        return $InventoryItems;
        
    }
}

?>