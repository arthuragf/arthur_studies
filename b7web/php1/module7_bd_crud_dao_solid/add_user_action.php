<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//require for db connection
require_once 'config.php';
require_once 'dao/UserDaoMySql.php';

//POST sanitize
$sName = filter_input(INPUT_POST, 'name');
$sEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Execute insert query
if($sName && $sEmail) {

    $clsUserDao = new UserDaoMySql($pdo);

    if(!$clsUserDao->getByEmail($sEmail) instanceof User){
        
        $oUser = new User();
        $oUser->setName($sName);
        $oUser->setEmail($sEmail);
        $clsUserDao->addUser($oUser);
        
        header('location:index.php');
        exit;
    } else {
        //Email exists, can't accept duplicity
        header('location:add_user.php');
        exit;
    }
} else {
    //ERROR: go to insert form
    header('location:add_user.php');
}