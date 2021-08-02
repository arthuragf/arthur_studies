<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class AuthController extends Controller{
    public function login(Request $clsRequest) {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $clsRequest) {
        if ($clsRequest->isPost()) {
            return "Handlign submitted data";
            
        }
        $this->setLayout('auth');
        return $this->render('register');
    }
}