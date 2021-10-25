<?php

class InventoryItem{
    
    private $Id;
    private $Name;
    private $Description;
    private $Quantity;
    private $HouseHoldId;
    
    function __construct(?string $Name, ?string $Description, ?int $Quantity, ?int $HouseHoldId){
        $this->setName($Name);
        $this->setDescription($Description);
        $this->setQuantity($Quantity);
        $this->setHouseHoldId($HouseHoldId);
    }
    
    function getId(){
        return $this->Id;
    }
    
    function setId(?int $Id){
        $this->Id = $Id;
    }
    
    function getName(){
        return $this->Name;
    }
    
    function setName(?string $Name){
        $this->Name = $Name;
    }
    
    function getDescription(){
        return $this->Description;
    }
    
    function setDescription(?string $Description){
        $this->Description = $Description;
    }
    
    function getQuantity(){
        return $this->Quantity;
    }
    
    function setQuantity(?int $Quantity){
        $this->Quantity = $Quantity;
    }
    
    function getHouseHoldId(){
        return $this->HouseHoldId;
    }
    
    function setHouseHoldId(?int $HouseHoldId){
        $this->HouseHoldId = $HouseHoldId;
    }
    
}

?>