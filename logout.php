<?php
namespace cst323;
session_start();
require_once 'Autoloader.php';
require_once 'session.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler(__DIR__ . '/app.log', Logger::DEBUG));
$logger->debug("Entering Logout:", ['session' => session_id(), 'handler' => 'logout', 'mode' => 'logout',
    "UserID:" => getUserID(), "UserName:" => getUserName()]);
$_SESSION = array();
session_destroy();
$message = "<div class='alert alert-success'>Logout Successful.</div>";
header('Location: index.php');
?>