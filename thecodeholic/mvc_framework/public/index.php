<?php
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$aConfig = [
    'sUserClass' => \app\models\User::class,
    'db' => [
        'sDsn' => $_ENV['DB_DSN']
        , 'sUser' => $_ENV['DB_USER']
        , 'sPassword' => $_ENV['DB_PASSWORD']
    ]
];

$clsApp = new Application(dirname(__DIR__), $aConfig);

if (!empty($_ENV['DEBUG_MODE'])) {
    $clsApp->on(Application::EVENT_BEFORE_REQUEST, function(){
        echo 'Before request';
    });
    $clsApp->on(Application::EVENT_AFTER_REQUEST, function(){
        echo 'After request';
    });
}

$clsApp->clsRouter->get('/', [SiteController::class, 'home']);
$clsApp->clsRouter->get('/contact', [SiteController::class, 'contact']);
$clsApp->clsRouter->post('/contact', [SiteController::class, 'contact']);
$clsApp->clsRouter->get('/login', [AuthController::class, 'login']);
$clsApp->clsRouter->post('/login', [AuthController::class, 'login']);
$clsApp->clsRouter->get('/register', [AuthController::class, 'register']);
$clsApp->clsRouter->post('/register', [AuthController::class, 'register']);
$clsApp->clsRouter->get('/logout', [AuthController::class, 'logout']);
$clsApp->clsRouter->get('/profile', [AuthController::class, 'profile']);

$clsApp->run();