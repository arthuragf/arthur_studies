<?php
require_once 'config.php';
require_once 'dao/UserDaoMySql.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nId = filter_input(INPUT_GET, 'id');
$oUser = new stdClass();
if ($nId) {
    $clsUserDao = new UserDaoMySql($pdo);
    $oUser = $clsUserDao->getById($nId);
}
if (!$oUser instanceof User) {
    header('location:index.php');
    exit;
}
?>

<h1>Edit User</h1>

<form method="POST" action="edit_user_action.php">
    <input type="hidden" name="id" value="<?= $oUser->getId(); ?>" />
    <label>
        Name:<br />
        <input type="text" name="name" value="<?= $oUser->getName(); ?>" />
    </label><br /><br />
    <label>
        E-mail:<br />
        <input type="email" name="email" value="<?= $oUser->getEmail(); ?>"/>
    </label><br /><br />
    <input type="submit" value="Edit User" />
</form>