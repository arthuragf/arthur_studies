<?php
namespace app\core;

class Controller {
    public string $sLayout = 'main';
    public function setLayout($sLayout) {
        $this->sLayout = $sLayout;
    }

    public function render($sView, $aParams = []) {
        return Application::$clsApp->clsRouter->renderView($sView, $aParams);
    }
}