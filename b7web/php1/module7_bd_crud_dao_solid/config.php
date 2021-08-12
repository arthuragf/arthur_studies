<?php
//TODO: create config.ini to set configurations and use ini_get();
$sDbName = 'b7web';
$sDbHost = 'localhost';
$sDbUser = 'admin';
$sDbPass = 'admin';

$pdo = new PDO("mysql:host=$sDbHost;dbname=$sDbName", $sDbUser, $sDbPass);