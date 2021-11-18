<?php

/**
 * InventoryItem
 * Object to encapuslate items added to household inventory.
 */
class InventoryItem{
        
    /**
     * Id
     * Unique ID for the inventory item object.
     * @var int
     */
    private $Id;    
    /**
     * Name
     * Name of the inventory item object.
     * @var string
     */
    private $Name;    
    /**
     * Description
     * Description of the inventory item object.
     * @var string
     */
    private $Description;    
    /**
     * Quantity
     * Number of the inventory item object.
     * @var int
     */
    private $Quantity;    
    /**
     * HouseHoldId
     * Unique ID of the household in which inventory item resides.
     * @var int
     */
    private $HouseHoldId;
        
    /**
     * __construct
     * Create the Inventory Item object.
     * @param  string $Name
     * @param  string $Description
     * @param  int $Quantity
     * @param  int $HouseHoldId
     * @return void
     */
    function __construct(?string $Name, ?string $Description, ?int $Quantity, ?int $HouseHoldId){
        $this->setName($Name);
        $this->setDescription($Description);
        $this->setQuantity($Quantity);
        $this->setHouseHoldId($HouseHoldId);
    }
        
    /**
     * getId
     * Return the unique ID of the inventory item object.
     * @return int
     */
    function getId(){
        return $this->Id;
    }
        
    /**
     * setId
     * Set the ID of the inventory item object.
     * @param  int $Id
     * @return void
     */
    function setId(?int $Id){
        $this->Id = $Id;
    }
        
    /**
     * getName
     * Return the name of the inventory item object.
     * @return string
     */
    function getName(){
        return $this->Name;
    }
        
    /**
     * setName
     * Set the name of the Invetory Item object.
     * @param  string $Name
     * @return void
     */
    function setName(?string $Name){
        $this->Name = $Name;
    }
        
    /**
     * getDescription
     * Get the description of the inventory item object.
     * @return string
     */
    function getDescription(){
        return $this->Description;
    }
        
    /**
     * setDescription
     * Set the description of the inventory item object.
     * @param  string $Description
     * @return void
     */
    function setDescription(?string $Description){
        $this->Description = $Description;
    }
        
    /**
     * getQuantity
     * Get the quantity of the inventory item object.
     * @return int
     */
    function getQuantity(){
        return $this->Quantity;
    }
        
    /**
     * setQuantity
     * Set the quantity of the inventory item object.
     * @param  int $Quantity
     * @return void
     */
    function setQuantity(?int $Quantity){
        $this->Quantity = $Quantity;
    }
        
    /**
     * getHouseHoldId
     * Get the associated household id for the inventory item object.
     * @return int
     */
    function getHouseHoldId(){
        return $this->HouseHoldId;
    }
        
    /**
     * setHouseHoldId
     * Set the assocaited household id for the inventory item object.
     * @param  int $HouseHoldId
     * @return void
     */
    function setHouseHoldId(?int $HouseHoldId){
        $this->HouseHoldId = $HouseHoldId;
    }
    
}

?>