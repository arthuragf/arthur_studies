<?php
class homeController extends Controller {

    public function index() {
        
        $aData = [
            'nPosts' => 5
            , 'sName' => 'Arthur'
        ];

        $this->loadTemplate('home', $aData);
    }

}