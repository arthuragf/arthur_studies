<?php
namespace app\core;
class Application {
    public static string $ROOT_DIR;
    public static Application $clsApp;
    public string $sUserClass;
    public Database $clsDb;
    public Router $clsRouter;
    public Request $clsRequest;
    public Response $clsResponse;
    public Controller $clsController;
    public Session $clsSession;
    public ?DbModel $oUser;
    

    public function __construct($sRootPath, array $aConfig) {
        $this->sUserClass = $aConfig['sUserClass'];
        self::$ROOT_DIR = $sRootPath;
        self::$clsApp = $this;
        $this->clsSession = new Session();
        $this->clsRequest = new Request();
        $this->clsResponse = new Response();
        $this->clsRouter = new Router($this->clsRequest, $this->clsResponse);
        $this->clsDb = new Database($aConfig['db']);

        $clsUser = new $this->sUserClass;
        $sPrimaryKey = $clsUser->primaryKey();
        $nPrimaryValue = $this->clsSession->get('user');
        if ($nPrimaryValue) {
           $this->oUser = $clsUser->findOne([$sPrimaryKey => $nPrimaryValue]);
        } else {
            $this->oUser = null;
        }
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

    public function login(DbModel $oUser) {
        $this->oUser = $oUser;
        $sPrimaryKey = $oUser->primaryKey();
        $nPrimaryValue = $oUser->{$sPrimaryKey};
        $this->clsSession->set('user', $nPrimaryValue);
        return true;
    }

    public function logout() {
        $this->oUser = null;
        $this->clsSession->unset('user');
    }

    public static function isGuest() {
        return !self::$clsApp->oUser;
    }
}