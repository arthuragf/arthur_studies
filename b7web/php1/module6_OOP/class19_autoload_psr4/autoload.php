<?php
spl_autoload_register(function($sClass){
    $sBaseDir = __DIR__ . '/classes/';
    $sFile = $sBaseDir . str_replace('\\', '/', $sClass) . '.class.php';
    if(file_exists($sFile))
        require_once $sFile;
});