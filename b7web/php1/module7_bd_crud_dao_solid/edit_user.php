<?php
require_once 'config.php';

$nId = filter_input(INPUT_GET, 'id');
if ($nId) {
    $oSql = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $oSql->bindValue(':id', $nId);
    $oSql->execute();
    if ($oSql->rowCount() > 0) {
        $aUser = $oSql->fetch(PDO::FETCH_ASSOC);
    } else {
        header('location:index.php');
        exit;
    }
} else {
    header('location:index.php');
    exit;
}
?>

<h1>Edit User</h1>

<form method="POST" action="edit_user_action.php">
    <input type="hidden" name="id" value="<?= $aUser['id'] ?>" />
    <label>
        Name:<br />
        <input type="text" name="name" value="<?= $aUser['name'] ?>" />
    </label><br /><br />
    <label>
        E-mail:<br />
        <input type="email" name="email" value="<?= $aUser['email'] ?>"/>
    </label><br /><br />
    <input type="submit" value="Edit User" />
</form>