<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;


class AuthController extends Controller{
    public function login(Request $clsRequest) {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $clsRequest) {
        $clsUser = new User();
        if ($clsRequest->isPost()) {
            $clsUser->loadData($clsRequest->getBody());
            
            if ($clsUser->validate() && $clsUser->save()) {
                Application::$clsApp->clsSession->setFlash('success', 'Thanks for registering');
                Application::$clsApp->clsResponse->redirect('/');
            }

            return $this->render('register', [
                'clsUser' => $clsUser
            ]);
            
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'clsUser' => $clsUser
        ]);
    }
}