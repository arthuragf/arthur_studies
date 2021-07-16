<?php
$pdo = new PDO('mysql:host=localhost;dbname=b7web', 'admin', 'admin');

$sql = $pdo->query('SELECT * FROM users');

echo "COUNT: {$sql->rowCount()} \r\n";

$dados = $sql->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';

print_r($dados);
