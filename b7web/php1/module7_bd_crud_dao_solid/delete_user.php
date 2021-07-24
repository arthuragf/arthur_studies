<?php
require_once 'config.php';
require_once 'dao/UserDaoMySql.php';

$nId = filter_input(INPUT_GET, 'id');

if ($nId) {
    $clsUserDao = new UserDaoMySql($pdo);
    $clsUserDao->deleteUser($nId);
}

header('location:index.php');
exit;