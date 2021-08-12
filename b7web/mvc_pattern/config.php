<?php
require 'environment.php';

$aConfig = [];

if (ENVIRONMENT == 'development') {
    define('COMMON_URL', 'http://localhost/arthur_studies/b7web/mvc_pattern/');
    $aConfig['dbname'] = 'mvc_pattern';
    $aConfig['host'] = 'localhost';
    $aConfig['dbuser'] = 'admin';
    $aConfig['dbpass'] = 'admin';
} elseif (ENVIRONMENT == 'production') {
    //Server configuration
}

global $oDb;
try {
    $oDb = new PDO(
        'mysql:dbname=' . $aConfig['dbname'] . ';host='.$aConfig['host']
        , $aConfig['dbuser']
        , $aConfig['dbpass']
    );
} catch(PDOException $e) {
    echo "ERRO: " . $e->getMessage();
    exit;
}