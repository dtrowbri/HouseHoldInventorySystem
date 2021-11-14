<?php
   
/**
 * User
 * Object to encapsulate user data.
 */
class User {
        
    /**
     * Id
     * Unique ID for the user object.
     * @var int
     */
    private $Id;    
    /**
     * Email
     * Email address for the user object.
     * @var string
     */
    private $Email;    
    /**
     * FirstName
     * First name of the user object.
     * @var string
     */
    private $FirstName;    
    /**
     * LastName
     * Last name of the user object.
     * @var string
     */
    private $LastName;
    /**
     * password
     * Holds the password of the user object.
     * @var string
     */
    private $password;
        
    /**
     * __construct
     * Create the user object. 
     * Password and ID is not passed into the constructor.
     * @param  string $Email
     * @param  string $FirstName
     * @param  string $LastName
     * @return void
     */
    function __construct(?string $Email, ?string $FirstName, ?string $LastName){
        $this->setEmail($Email);
        $this->setFirstName($FirstName);
        $this->setLastName($LastName);
    }
        
    /**
     * getId
     * Return the unique ID of the user object.
     * @return int
     */
    function getId(){
        return $this->Id;
    }
        
    /**
     * setId
     * Set the ID of the user object.
     * @param  int $Id
     * @return void
     */
    function setId(?int $Id){
        $this->Id = $Id;
    }
        
    /**
     * getEmail
     * Return the email address of the user object.
     * @return string
     */
    function getEmail(){
        return $this->Email;
    }
        
    /**
     * setEmail
     * Set the email address of the user object.
     * @param  string $Email
     * @return void
     */
    function setEmail(?string $Email){
        $this->Email = $Email;
    }
        
    /**
     * getFirstName
     * Return the first name of the user object.
     * @return string
     */
    function getFirstName(){
        return $this->FirstName;
    }
        
    /**
     * setFirstName
     * Set the first name of the user object.
     * @param  string $FirstName
     * @return void
     */
    function setFirstName(?string $FirstName){
        $this->FirstName = $FirstName;
    }
        
    /**
     * getLastName
     * Return the last name of the user object.
     * @return string
     */
    function getLastName(){
        return $this->LastName;
    }
        
    /**
     * setLastName
     * Set the last name of the user object.
     * @param  string $LastName
     * @return void
     */
    function setLastName(?string $LastName){
        $this->LastName = $LastName;
    }
        
    /**
     * getPassword
     * Return the password of the user object.
     * @return string
     */
    function getPassword(){
        return $this->password;
    }
        
    /**
     * setPassword
     * Set the password of the user object.
     * @param  string $Password
     * @return void
     */
    function setPassword(?string $Password){
        $this->password = $Password;
    }
}

?>