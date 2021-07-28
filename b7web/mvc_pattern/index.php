<?php
session_start();
require 'config.php';

spl_autoload_register(function($sClass){
    
    $sFile = $sClass . '.class.php';
    if (file_exists('controllers/' . $sFile)) {
        require 'controllers/' . $sFile;
    } elseif (file_exists('models/' . $sFile)) {
        require 'models/' . $sFile;
    } elseif (file_exists('core/' . $sFile)) {
        require 'core/' . $sFile;    
    }
});

$oCore = new Core();
$oCore->run();