<?php 
require_once 'business/interfaces/idatabase.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

<<<<<<< HEAD
/**
 * Database
 * Implements the IDatabase interface which required the getConnection function.
 * Returns a connection to a Database using the \PDO framework.
 */
class Database implements IDatabase {    
    /**
     * logger
     * Variable to hold logger instance.
     * @var Logger
     */
    private $logger = null;
    
    //private $dsn = 'mysql:dbname=householdinventory;host=127.0.0.1;port=3306';    
    //private $username = 'root';    
    //private $password = 'root';
    
    /**
     * dsn
     * Connection string to be used within \PDO db connection
     * @var string
     */
=======
class Database implements IDatabase {
>>>>>>> parent of e54d02a (adding namespace information)
    private $dsn = 'mysql:dbname=householdinventory;host=127.0.0.1;port=49406';
    /**
     * username
     * String to hold username needed for \PDO db connection.
     * @var string
     */
    private $username = 'azure';
    /**
     * password
     * String to hold password needed for \PDO db connection.
     * @var string
     */
    private $password = '6#vWHD_$';
<<<<<<< HEAD
        
    /**
     * getConnection
     * Function to establish connection to database.
     * @return \PDO
     */
=======
    private $logger = null;
    
>>>>>>> parent of e54d02a (adding namespace information)
    function getConnection(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__. '/../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
        $this->logger->info("Creating UserDAO", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
        
        $this->logger->info("Creating connection to database", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
        $conn = new PDO($this->dsn, $this->username, $this->password);
        
        if($conn){
            $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
            return $conn;
        } else {
            $this->logger->warning("There was an issue connecting to the database", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
            $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
            return null;
        }
    }
}

?>