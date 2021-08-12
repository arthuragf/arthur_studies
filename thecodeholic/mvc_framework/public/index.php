<?php
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$aConfig = [
    'db' => [
        'sDsn' => $_ENV['DB_DSN']
        , 'sUser' => $_ENV['DB_USER']
        , 'sPassword' => $_ENV['DB_PASSWORD']
    ]
];

$oApp = new Application(dirname(__DIR__), $aConfig);

$oApp->clsRouter->get('/', [SiteController::class, 'home']);
$oApp->clsRouter->get('/contact', [SiteController::class, 'contact']);
$oApp->clsRouter->post('/contact', [SiteController::class, 'handleContact']);
$oApp->clsRouter->get('/login', [AuthController::class, 'login']);
$oApp->clsRouter->post('/login', [AuthController::class, 'login']);
$oApp->clsRouter->get('/register', [AuthController::class, 'register']);
$oApp->clsRouter->post('/register', [AuthController::class, 'register']);

$oApp->run();
