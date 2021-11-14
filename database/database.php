<?php 
namespace cst323;
require_once 'business/interfaces/idatabase.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Database implements IDatabase {
    private $logger = null;

    /*
    private $dsn = 'mysql:dbname=householdinventory;host=127.0.0.1;port=3306';
    private $username = 'root';
    private $password = 'root';
    */
    
    private $dsn = 'mysql:dbname=householdinventory;host=127.0.0.1;port=49406';
    private $username = 'azure';
    private $password = '6#vWHD_$';
    
    function getConnection(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__. '/../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
        $this->logger->info("Creating UserDAO", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);
        
        $this->logger->info("Creating connection to database", ['session' => session_id(), 'class' => 'Database', 'method' => 'construct']);

        $conn = new \PDO($this->dsn, $this->username, $this->password);
        
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