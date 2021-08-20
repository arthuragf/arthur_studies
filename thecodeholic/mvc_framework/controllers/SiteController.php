<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Application;

class SiteController extends Controller {

    public function home() {
        $aParams = [
            'sName' => (!empty(Application::$clsApp->oUser)) 
            ? Application::$clsApp->oUser->getDisplayName() 
            : 'Guest'
        ];
        return $this->render('home', $aParams);
    }

    public function contact() {
        
        return $this->render('contact');
    }

    public function handleContact(Request $clsRequest) {
        $aBody = $clsRequest->getBody();
        print_r($aBody);
        return "Handling Submitted Data";
    }

}