<?php
require_once 'business/models/user.php';
require_once 'business/services/userService.php';
require_once 'business/services/authenticationService.php';
require_once 'session.php';

$email = $_POST['email'];
$password = hash("sha512", $_POST['password']);

if(isset($_POST['register'])) {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    //echo "inside UserHandler with register " . $email . " " . $password . " " . $firstname . " " . $lastname;
    $new_user = new User($email, $firstname, $lastname);
    $new_user->setPassword($password);

    $db = new UserService(getDatabase());

    $result = $db->AddUser($new_user);
    if($result) {
        $message = "<div class='alert-success'>Registration Successful.</div>";
    } else {
        $message = "<div class='alert-danger'>Registration Failed.</div>";
    }
    include('index.php');
    require_once 'footer.php'; 
}

if(isset($_POST['login'])) {
    //echo "<br>inside UserHandler with login " . $email . " " . $password;
    $db = new AuthenticationService(getDatabase());

    $result = $db->authenticate($email, $password);

    if($result) {
        $db = new UserService(getDatabase());
        $user_loggedin = $db->GetUser($email);
        saveUserId($user_loggedin->getId());
        saveUserName($user_loggedin->getFirstName(), $user_loggedin->getLastName());
        
        $message = "<div class='alert-success'>Login Successful. Welcome back ". getUserName()  ."!</div>";
    } else {
        $message = "<div class='alert-danger'>Login Failed.</div>";
    }
    include('index.php');

    require_once 'footer.php'; 
}

?>