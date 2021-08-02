<?php
namespace app\core;
class Application {
    public static string $ROOT_DIR;
    public Router $clsRouter;
    public Request $clsRequest;
    public Response $clsResponse;
    public static Application $clsApp;

    public function __construct($sRootPath) {
        self::$ROOT_DIR = $sRootPath;
        self::$clsApp = $this;
        $this->clsRequest = new Request();
        $this->clsResponse = new Response();
        $this->clsRouter = new Router($this->clsRequest, $this->clsResponse);
        
    }

    public function run() {
        echo $this->clsRouter->resolve();
    }
}