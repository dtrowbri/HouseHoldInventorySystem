<?php

class HouseHold{
    
    private $Id;
    private $Name;
    private $Address;
    private $UserId;
    
    function __construct(?string $Name, ?string $Address, ?int $UserId){
        $this->setName($Name);
        $this->setAddress($Address);
        $this->setUserId($UserId);
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
    
    function getAddress(){
        return $this->Address;
    }
    
    function setAddress(?string $Address){
        $this->Address = $Address;
    }
    
    function getUserId(){
        return $this->UserId;
    }
    
    function setUserId(?int $UserId){
        $this->UserId = $UserId;
    }
    
}

?>