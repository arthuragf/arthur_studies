<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Ads;

class HomeController extends Controller {

    public function index() {
        $clsAds = new Ads();
        $clsUsers = new Users();

        $aData = [
            'nAds' => $clsAds->getAds()  
            , 'sName' => $clsUsers->getName()
        ];

        $this->loadTemplate('home', $aData);
    }

}