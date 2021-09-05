<?php
namespace app\core;
use app\core\exceptions\NotFoundException;

class Router {
    protected array $aRoutes = [];
    public Request $clsRequest;
    public Response $clsResponse;

    public function __construct(Request $clsRequest, Response $clsResponse) {
        $this->clsRequest = $clsRequest;
        $this->clsResponse = $clsResponse;
    }

    public function get($path, $callback) {
        $this->aRoutes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->aRoutes['post'][$path] = $callback;
    }

    public function resolve() {
        $sPath = $this->clsRequest->getPath();
        $sMethod = $this->clsRequest->getMethod();
        $fnCallback = $this->aRoutes[$sMethod][$sPath] ?? false;

        if ($fnCallback === false) {
            throw new NotFoundException();
        }

        if (is_string($fnCallback)) {
            return $this->renderView($fnCallback);
        }

        if (is_array($fnCallback)) {
            /**
             * @var \app\core\Controller $clsController
             */
            $clsController = new $fnCallback[0]();
            Application::$clsApp->clsController = $clsController;
            $clsController->sAction = $fnCallback[1];
            $fnCallback[0] = $clsController;
        }
        
        foreach ($clsController->getMiddlewears() as $middleware) {
            $middleware->execute();
        }

        return call_user_func($fnCallback, $this->clsRequest, $this->clsResponse);
    }

    public function renderView($sView, $aParams = []) {
        $sLayoutContent = $this->getLayoutContent();
        $sViewContent = $this->getViewContent($sView, $aParams);
        return str_replace('{{content}}', $sViewContent, $sLayoutContent);
    }

    protected function getLayoutContent() {
        $sLayout = Application::$clsApp->sLayout;
        if (Application::$clsApp->clsController) {
            $sLayout = Application::$clsApp->clsController->sLayout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$sLayout.php";
        return ob_get_clean();

    }

    protected function getViewContent($sView, $aParams) {
        extract($aParams);
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$sView.php";
        return ob_get_clean();

    }
}