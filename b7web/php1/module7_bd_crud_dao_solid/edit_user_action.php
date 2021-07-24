<?php
//require for db connection
require_once 'config.php';
require_once 'dao/UserDaoMySql.php';

//POST sanitize
$nId = filter_input(INPUT_POST, 'id');
$sName = filter_input(INPUT_POST, 'name');
$sEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Execute update query
if($nId && $sName && $sEmail) {

    $clsUserDao = new UserDaoMySql($pdo);
    $oUser = new User();
    $oUser->setId($nId);
    $oUser->setName($sName);
    $oUser->setEmail($sEmail);
    $clsUserDao->editUser($oUser);
  
    header('location:index.php');
    exit;
} else {
    //ERROR: go to insert form
    header('location:edit_user.php?id=' . $nId);
}