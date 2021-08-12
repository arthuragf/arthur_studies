<?php
namespace Controllers;

use \Core\Controller;

class PageNotFoundController extends Controller{
    public function index() {
        $this->loadView('404',[]);
    }
}