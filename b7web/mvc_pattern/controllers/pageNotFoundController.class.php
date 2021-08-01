<?php
class pageNotFoundController extends Controller{
    public function index() {
        $this->loadView('404',[]);
    }
}