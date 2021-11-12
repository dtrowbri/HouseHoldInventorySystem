<?php
spl_autoload_register(function($class){
    require_once $class . '.php';
    require_once 'business/models/' . $class . '.php';
    require_once 'business/services/' . $class . '.php';
});
    require_once __DIR__ .'/vendor/autoload.php';
?>