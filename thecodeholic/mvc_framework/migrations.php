<?php
use app\core\Application;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$aConfig = [
    'db' => [
        'sDsn' => $_ENV['DB_DSN']
        , 'sUser' => $_ENV['DB_USER']
        , 'sPassword' => $_ENV['DB_PASSWORD']
    ]
];

$oApp = new Application(__DIR__, $aConfig);

$oApp->clsDb->applyMigrations();