<?php
require_once 'config.php';

$nId = filter_input(INPUT_GET, 'id');

if ($nId) {
    $oSql = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $oSql->bindValue(':id', $nId);
    $oSql->execute();
}

header('location:index.php');
exit;