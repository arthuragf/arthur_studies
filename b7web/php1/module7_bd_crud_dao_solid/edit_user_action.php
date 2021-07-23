<?php
//require for db connection
require_once 'config.php';

//POST sanitize
$nId = filter_input(INPUT_POST, 'id');
$sName = filter_input(INPUT_POST, 'name');
$sEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Execute update query
if($nId && $sName && $sEmail) {

    $oSqlEmail = $pdo->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
    $oSqlEmail->bindValue(':id', $nId);
    $oSqlEmail->bindValue(':name', $sName);
    $oSqlEmail->bindValue(':email', $sEmail);
    $oSqlEmail->execute();
  
    header('location:index.php');
    exit;
} else {
    //ERROR: go to insert form
    header('location:edit_user.php');
}