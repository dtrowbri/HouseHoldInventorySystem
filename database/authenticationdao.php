<?php
namespace cst323;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * AuthenticationDAO
 * Data Access Object for authentication purposes.
 * Used by the Authentication service.
 * Communicates with database to verify provided email and password for login.
 */
class AuthenticationDAO {
    
    /**
     * logger
     * Variable to hold logger instance.
     * @var Logger
     */
    private $logger = null;
        
    /**
     * __construct
     * Create the authentication DAO
     * @return void
     */
    public function __construct(){
        $this->logger = new Logger('main');
        $this->logger->pushHandler( new StreamHandler(__DIR__. '/../app.log', Logger::DEBUG));
        $this->logger->debug("Entering constructor", ['session' => session_id(), 'class' => 'AuthenticationDAO', 'method' => 'construct']);
        $this->logger->info("Creating AuthenticationDAO", ['session' => session_id(), 'class' => 'AuthenticationDAO', 'method' => 'construct']);
        $this->logger->debug("Exiting constructor", ['session' => session_id(), 'class' => 'AuthenticationDAO', 'method' => 'construct']);
    }
        
    /**
     * authenticate
     * Check with the DB if the provided strings match what is stored.
     * @param  string $Email
     * @param  string $Password
     * @param  \PDO $conn
     * @return bool
     */
    function authenticate(?string $Email, ?string $Password, $conn){
        $this->logger->debug("Entering method", ['session' => session_id(), 'class' => 'AuthenticationDAO', 'method' => 'authenticate']);
        $query = "select count(Email) as `count` from users where Email = ? and Password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $Email, \PDO::PARAM_STR);
        $stmt->bindParam(2, $Password, \PDO::PARAM_STR);
        
        try{
            $stmt->execute();
        } catch(Exception $e){
            $this->logger->error("Error: There was an error executing the authenticate query", ['session' => session_id(), 'Email' => $Email, 'class' => 'AuthenticationDAO', 'method' => 'authenticate']);   
        }
        
        $result = $stmt->fetch();
        //echo '<br>$result[count]:' . $result['count'];
        if($result['count'] == 1){
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'AuthenticationDAO', 'method' => 'authenticate']);
            return true;
        } else {
            $this->logger->debug("Exiting method", ['session' => session_id(), 'class' => 'AuthenticationDAO', 'method' => 'authenticate']);
            return false;
        }
    }
       
}
?>