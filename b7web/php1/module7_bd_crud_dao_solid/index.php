<?php
require_once 'config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$aUsers = [];
$oSql = $pdo->query('SELECT * FROM users');
if($oSql->rowCount() > 0) {
    $aUsers = $oSql->fetchAll(PDO::FETCH_ASSOC);           
}
?>

<a href="./add_user.php">Add User</a>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Actions</th>
    </tr>
    <?php foreach($aUsers as $aItem): ?>
        <tr>
            <td><?= $aItem['id']; ?></td>
            <td><?= $aItem['name']; ?></td>
            <td><?= $aItem['email']; ?></td>
            <td>
                <a href="./edit_user.php?id=<?= $aItem['id']; ?>">[ Edit ]</a>
                <a href="./delete_user.php?id=<?= $aItem['id']; ?>"
                    onclick="return confirm(
                        'Do you want to delete <?= $aItem['name'] ?> from users?'
                    )"
                >
                    [ Delete ]
                </a>
            </td>
        </tr> 
    <?php endforeach; ?>
</table>