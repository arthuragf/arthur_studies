<?php
require_once __DIR__ . '/../vendor/autoload.php';
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

$oApp = new Application(dirname(__DIR__));

$oApp->clsRouter->get('/', [SiteController::class, 'home']);
$oApp->clsRouter->get('/contact', [SiteController::class, 'contact']);
$oApp->clsRouter->post('/contact', [SiteController::class, 'handleContact']);
$oApp->clsRouter->get('/login', [AuthController::class, 'login']);
$oApp->clsRouter->post('/login', [AuthController::class, 'login']);
$oApp->clsRouter->get('/register', [AuthController::class, 'register']);
$oApp->clsRouter->post('/register', [AuthController::class, 'register']);

$oApp->run();