<?php
session_start();
require 'config.php';
require 'routes.php';



spl_autoload_register(function($sClass){
    $sBaseDir = dirname(__FILE__);
    
    $sFile = str_replace('\\', '/', $sClass) . '.class.php';

    if (file_exists($sFile)) {
        require $sFile;
    }
});

$oCore = new Core\Core();
$oCore->run();