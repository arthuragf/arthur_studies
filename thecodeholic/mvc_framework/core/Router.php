<?php
namespace app\core;
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
            $this->clsResponse->setStatusCode('404');
            return $this->renderView('_404');
        }

        if (is_string($fnCallback)) {
            return $this->renderView($fnCallback);
        }

        if (is_array($fnCallback)) {
            //$fnCallback[0] = new $fnCallback[0]();
            Application::$clsApp->clsController = $fnCallback[0] = new $fnCallback[0]();
        }
        
        return call_user_func($fnCallback, $this->clsRequest);
    }

    public function renderView($sView, $aParams = []) {
        $sLayoutContent = $this->getLayoutContent();
        $sViewContent = $this->getViewContent($sView, $aParams);
        return str_replace('{{content}}', $sViewContent, $sLayoutContent);
    }

    protected function getLayoutContent() {
        
        $sLayout = Application::$clsApp->clsController->sLayout;
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