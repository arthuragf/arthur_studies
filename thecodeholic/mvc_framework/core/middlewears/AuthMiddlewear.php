<?php

namespace app\core\middlewears;
use app\core\exceptions\ForbiddenException;
use app\core\Application;

class AuthMiddlewear extends BaseMiddlewear{

    public array $aActions = [];

    public function __construct(array $aActions = []) {
        $this->aActions = $aActions;
    }

    public function execute() {
        if(Application::isGuest()) {
            if (empty($this->aActions) 
                || in_array(
                        Application::$clsApp->clsController->sAction
                        , $this->aActions
                    )
                ) 
            {
               throw new ForbiddenException();
            }
        }
    }
}