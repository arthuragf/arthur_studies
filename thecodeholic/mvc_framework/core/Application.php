<?php
namespace app\core;
class Application {
    public static string $ROOT_DIR;
    public static Application $clsApp;
    public Database $clsDb;
    public Router $clsRouter;
    public Request $clsRequest;
    public Response $clsResponse;
    public Controller $clsController;
    public Session $clsSession;
    

    public function __construct($sRootPath, array $aConfig) {
        self::$ROOT_DIR = $sRootPath;
        self::$clsApp = $this;
        $this->clsSession = new Session();
        $this->clsRequest = new Request();
        $this->clsResponse = new Response();
        $this->clsRouter = new Router($this->clsRequest, $this->clsResponse);
        $this->clsDb = new Database($aConfig['db']);
    }

    public function getController() {
        return $this->clsController;
    }

    public function setClsController(Controller $clsController) {
        $this->clsController = $clsController;
    }

    public function run() {
        echo $this->clsRouter->resolve();
    }
}