<?php
namespace cst323;
require_once 'database/database.php';
require_once 'database/authenticationdao.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * AuthenticationService
 * Service to handle authentication (login validation) requests
 */
class AuthenticationService{
        
    /**
     * database
     * Variable to hold database instance.
     * @var IDatabase
     */
    private $database;    
    /**
     * logger
     * Variable to hold logger instance.
     * @var Logger
     */
    private $logger = null;
        
    /**
     * __construct
     * Construct the authentication service. 
     * @param  IDatabase $database
     * @return void
     */
    function __construct(?IDatabase $database){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__. '/../../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'AuthenticationService', 'method' => 'construct']);
        $this->logger->info("Creating Authentication Service", ['session' => session_id(), 'class' => 'AuthenticationService', 'method' => 'construct']);
        $this->database = $database;
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'AuthenticationService', 'method' => 'construct']);
    }
        
    /**
     * authenticate
     * Function to compare provided email and hashed password to DB for authentication purposes.
     * Function expects to receive pre-hashed password.
     * @param  string $Email
     * @param  string $Password
     * @return bool
     */
    function authenticate(?string $Email, ?string $Password){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'AuthenticationService', 'method' => 'authenticate']);
        $this->logger->info("Authenticating user", ['session' => session_id(), 'user' => $Email, 'class' => 'AuthenticationService', 'method' => 'authenticate']);

        $conn = $this->database->getConnection();
        $dao = new AuthenticationDAO();
        
        //$Password = hash("sha512", $Password);  hasing on the handler so actual password is never used anywhere.
        $isSuccessful = $dao->authenticate($Email, $Password, $conn);
        
        $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'AuthenticationService', 'method' => 'authenticate']);
        return $isSuccessful;
    }
}

?>