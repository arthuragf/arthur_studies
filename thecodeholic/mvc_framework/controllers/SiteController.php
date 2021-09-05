<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Application;
use app\core\Response;
use app\models\ContactForm;

class SiteController extends Controller {

    public function home() {
        $aParams = [
            'sName' => (!empty(Application::$clsApp->oUser)) 
            ? Application::$clsApp->oUser->getDisplayName() 
            : 'Guest'
        ];
        return $this->render('home', $aParams);
    }

    public function contact(Request $clsRequest, Response $clsResponse) {
        $clsContact = new ContactForm();
        if ($clsRequest->isPost()) {
            $clsContact->loadData($clsRequest->getBody());
            if($clsContact->validate() && $clsContact->send()) {
                Application::$clsApp->clsSession->setFlash('success', 'Thanks for contacting us.');
                return $clsResponse->redirect('/contact');
            }
        }
        return $this->render('contact', ['clsModel' => $clsContact]);
    }
}