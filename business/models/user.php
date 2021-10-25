<?php
   
class User {
    
    private $Id;
    private $Email;
    private $FirstName;
    private $LastName;
    private $password;
    
    function __construct(?string $Email, ?string $FirstName, ?string $LastName){
        $this->setEmail($Email);
        $this->FirstName($FirstName);
        $this->LastName($LastName);
    }
    
    function getId(){
        return $this->Id;
    }
    
    function setId(?int $Id){
        $this->Id = $Id;
    }
    
    function getEmail(){
        return $this->Email;
    }
    
    function setEmail(?string $Email){
        $this->Email = $Email;
    }
    
    function getFirstName(){
        return $this->FirstName;
    }
    
    function setFirstName(?string $FirstName){
        $this->FirstName = $FirstName;
    }
    
    function getLastName(){
        return $this->LastName;
    }
    
    function setLastName(?string $LastName){
        $this->LastName;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function setPassword(?string $Password){
        $this->password = $Password;
    }
}

?>