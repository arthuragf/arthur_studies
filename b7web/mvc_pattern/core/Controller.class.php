<?php
class Controller {

    public function loadView($sViewName, $aData = []) {
        extract($aData);
        require 'views/' . $sViewName . '.php';

    }

    public function loadTemplate($sViewName, $aData = []) {
        require 'views/template.php';
    }

    public function loadTemplateView($sViewName, $aData = []) {
        extract($aData);
        require 'views/' . $sViewName . '.php';

    }
}