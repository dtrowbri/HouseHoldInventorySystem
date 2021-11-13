<?php

/**
 * HouseHold
 * object to encapsulate household information.
 */
class HouseHold{
        
    /**
     * Id
     *
     * @var int
     */
    private $Id;    
    /**
     * Name
     *
     * @var string
     */
    private $Name;    
    /**
     * Address
     *
     * @var string
     */
    private $Address;    
    /**
     * UserId
     *
     * @var int
     */
    private $UserId;
        
    /**
     * __construct
     *
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
     *
     * @return int
     */
    function getId(){
        return $this->Id;
    }
        
    /**
     * setId
     *
     * @param  int $Id
     * @return void
     */
    function setId(?int $Id){
        $this->Id = $Id;
    }
        
    /**
     * getName
     *
     * @return string
     */
    function getName(){
        return $this->Name;
    }
        
    /**
     * setName
     *
     * @param  string $Name
     * @return void
     */
    function setName(?string $Name){
        $this->Name = $Name;
    }
        
    /**
     * getAddress
     *
     * @return string
     */
    function getAddress(){
        return $this->Address;
    }
        
    /**
     * setAddress
     *
     * @param  string $Address
     * @return void
     */
    function setAddress(?string $Address){
        $this->Address = $Address;
    }
        
    /**
     * getUserId
     *
     * @return int
     */
    function getUserId(){
        return $this->UserId;
    }
        
    /**
     * setUserId
     *
     * @param  int $UserId
     * @return void
     */
    function setUserId(?int $UserId){
        $this->UserId = $UserId;
    }
    
}

?>