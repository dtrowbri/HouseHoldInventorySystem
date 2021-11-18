<?php

/**
 * HouseHold
 * Object to encapsulate household information.
 */
class HouseHold{
        
    /**
     * Id
     * Unique ID to for the household objects.
     * @var int
     */
    private $Id;    
    /**
     * Name
     * Name of the household object.
     * @var string
     */
    private $Name;    
    /**
     * Address
     * Address of the household object.
     * Any format is acceptable.
     * @var string
     */
    private $Address;    
    /**
     * UserId
     * Associated User Object ID for the household object.
     * @var int
     */
    private $UserId;
        
    /**
     * __construct
     * Construct the household object.
     * @param  string $Name
     * @param  string $Address
     * @param  int $UserId
     * @return void
     */
    function __construct(?string $Name, ?string $Address, ?int $UserId){
        $this->setName($Name);
        $this->setAddress($Address);
        $this->setUserId($UserId);
    }
        
    /**
     * getId
     * Return the household object's unique id.
     * @return int
     */
    function getId(){
        return $this->Id;
    }
        
    /**
     * setId
     * Set the household object's id.
     * @param  int $Id
     * @return void
     */
    function setId(?int $Id){
        $this->Id = $Id;
    }
        
    /**
     * getName
     * Get the household object's name.
     * @return string
     */
    function getName(){
        return $this->Name;
    }
        
    /**
     * setName
     * Set the household object's name.
     * @param  string $Name
     * @return void
     */
    function setName(?string $Name){
        $this->Name = $Name;
    }
        
    /**
     * getAddress
     * Get the household object's address.
     * @return string
     */
    function getAddress(){
        return $this->Address;
    }
        
    /**
     * setAddress
     * Set the household object's address.
     * @param  string $Address
     * @return void
     */
    function setAddress(?string $Address){
        $this->Address = $Address;
    }
        
    /**
     * getUserId
     * Get the household object's assosciated User object ID
     * @return int
     */
    function getUserId(){
        return $this->UserId;
    }
        
    /**
     * setUserId
     * Set the household object's assosciated User object ID
     * @param  int $UserId
     * @return void
     */
    function setUserId(?int $UserId){
        $this->UserId = $UserId;
    }
    
}

?>