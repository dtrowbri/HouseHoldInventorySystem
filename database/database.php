<?php 
require_once 'business/interfaces/idatabase.php';

class Database implements IDatabase {
    private $dsn = 'mysql:dbname=householdinventory;host=127.0.0.1;port=3306';
    private $username = 'root';
    private $password = 'root';
    
    function getConnection(){
        $conn = new PDO($this->dsn, $this->username, $this->password);
        
        if($conn){
            return $conn;
        } else {
            return null;
        }
    }
}

?>