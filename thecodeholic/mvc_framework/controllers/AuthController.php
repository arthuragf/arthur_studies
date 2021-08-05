<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller{
    public function login(Request $clsRequest) {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $clsRequest) {
        $clsRegisterModel = new RegisterModel();
        if ($clsRequest->isPost()) {
            $clsRegisterModel->loadData($clsRequest->getBody());
            
            if ($clsRegisterModel->validate() && $clsRegisterModel->register()) {
                return 'Success';
            }

            return $this->render('register', [
                'clsRegisterModel' => $clsRegisterModel
            ]);
            
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'clsRegisterModel' => $clsRegisterModel
        ]);
    }
}