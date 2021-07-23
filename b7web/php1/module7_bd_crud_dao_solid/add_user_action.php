<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
//require for db connection
require_once 'config.php';

//POST sanitize
$sName = filter_input(INPUT_POST, 'name');
$sEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Execute insert query
if($sName && $sEmail) {

    $oSql = $pdo->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
    $oSql->bindParam(':name', $sName);
    $oSql->bindParam(':email', $sEmail);
    $oOk = $oSql->execute();

    header('location:index.php');
    exit;
} else {
    //ERROR: go to insert form
    header('location:add_user.php');
}