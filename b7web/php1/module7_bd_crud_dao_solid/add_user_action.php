<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//require for db connection
require_once 'config.php';

//POST sanitize
$sName = filter_input(INPUT_POST, 'name');
$sEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Execute insert query
if($sName && $sEmail) {

    $oSqlEmail = $pdo->prepare('SELECT id FROM users where email = :email');
    $oSqlEmail->bindValue(':email', $sEmail);
    $oSqlEmail->execute();
  
    if (!$oSqlEmail->rowCount()) {
        $oSql = $pdo->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
        $oSql->bindValue(':name', $sName);
        $oSql->bindValue(':email', $sEmail);
        $oOk = $oSql->execute();
    } else {
        //Email exists, can't accept duplicity
        header('location:add_user.php');
        exit;
    }

    header('location:index.php');
    exit;
} else {
    //ERROR: go to insert form
    header('location:add_user.php');
}