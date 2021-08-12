<?php
namespace Core;

class Controller {

    public function loadView($sViewName, $aData = []) {
        extract($aData);
        require 'Views/' . $sViewName . '.php';

    }

    public function loadTemplate($sViewName, $aData = []) {
        require 'Views/template.php';
    }

    public function loadTemplateView($sViewName, $aData = []) {
        extract($aData);
        require 'Views/' . $sViewName . '.php';

    }
}