<?php
namespace cst323;
require_once 'business/models/user.php';
require_once 'business/services/userService.php';
require_once 'business/services/authenticationService.php';
require_once 'session.php';
require_once 'Autoloader.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$email = $_POST['email'];
$password = hash("sha512", $_POST['password']);

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler(__DIR__ . '/app.log', Logger::DEBUG));

if(isset($_POST['register'])) {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $logger->debug("Entering user handler, registration:", ['session' => session_id(), 'handler' => 'user', 'mode' => 'registration', 'email' => $email, 'first name' => $firstname, 'last name' => $lastname]);
    $new_user = new User($email, $firstname, $lastname);
    $new_user->setPassword($password);

    $db = new UserService(getDatabase());

    $result = $db->AddUser($new_user);
    if($result) {
        $logger->debug("Inside user handler, registration success:", ['session' => session_id(), 'handler' => 'user', 'mode' => 'registration', 'email' => $email, 'first name' => $firstname, 'last name' => $lastname]);
        $message = "<div class='alert alert-success'>Registration Successful.</div>";
    } else {
        $logger->error("Inside user handler, registration failure:", ['session' => session_id(), 'handler' => 'user', 'mode' => 'registration', 'email' => $email, 'first name' => $firstname, 'last name' => $lastname]);
        $message = "<div class='alert alert-danger'>Registration Failed.</div>";
    }
    include('index.php');
    require_once 'footer.php'; 
}

if(isset($_POST['login'])) {
    $logger->debug("User handler, login:", ['session' => session_id(), 'handler' => 'user', 'mode' => 'login', 'email' => $email]);
    $db = new AuthenticationService(getDatabase());

    $result = $db->authenticate($email, $password);

    if($result) {
        $db = new UserService(getDatabase());
        $user_loggedin = $db->GetUser($email);
        saveUserId($user_loggedin->getId());
        saveUserName($user_loggedin->getFirstName(), $user_loggedin->getLastName());
        
        $logger->debug("User handler, login  success:", ['session' => session_id(), 'handler' => 'user', 'mode' => 'login', 'email' => $email]);
        $message = "<div class='alert alert-success'>Login Successful. Welcome back ". getUserName()  ."!</div>";
    } else {
        $logger->error("User handler, login  failed:", ['session' => session_id(), 'handler' => 'user', 'mode' => 'login', 'email' => $email]);
        $message = "<div class='alert alert-danger'>Login Failed.</div>";
    }
    include('index.php');

    require_once 'footer.php'; 
}

?>