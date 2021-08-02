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

    public function resolve() {
        $sPath = $this->clsRequest->getPath();
        $sMethod = $this->clsRequest->getMethod();
        $fnCallback = $this->aRoutes[$sMethod][$sPath] ?? false;
        if (is_string($fnCallback)) {
            return $this->renderView($fnCallback);
        }

        if (!is_callable($fnCallback)) {
            
            $this->clsResponse->setStatusCode('404');
            return 'Not Found';
        }
        
        return call_user_func($fnCallback);
    }

    public function renderView($sView) {
        $sLayoutContent = $this->getLayoutContent();
        $sViewContent = $this->getViewContent($sView);
        return str_replace('{{content}}', $sViewContent, $sLayoutContent);
    }

    protected function getLayoutContent() {

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();

    }

    protected function getViewContent($sView) {

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$sView.php";
        return ob_get_clean();

    }
}