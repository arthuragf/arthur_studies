<?php
require_once 'config.php';
require_once 'dao/UserDaoMySql.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$clsUserDao = new UserDaoMySql($pdo);
$aUsers = $clsUserDao->getUsers();
?>

<a href="./add_user.php">Add User</a>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Actions</th>
    </tr>
    <?php foreach($aUsers as $oUser): ?>
        <tr>
            <td><?= $oUser->getId(); ?></td>
            <td><?= $oUser->getName(); ?></td>
            <td><?= $oUser->getEmail(); ?></td>
            <td>
                <a href="./edit_user.php?id=<?= $oUser->getId(); ?>">[ Edit ]</a>
                <a href="./delete_user.php?id=<?= $oUser->getId(); ?>"
                    onclick="return confirm(
                        'Do you want to delete <?= $oUser->getName(); ?> from users?'
                    )"
                >
                    [ Delete ]
                </a>
            </td>
        </tr> 
    <?php endforeach; ?>
</table>