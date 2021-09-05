<?php
namespace app\core;

use app\core\db\Database;

class Application {
    public static string $ROOT_DIR;
    public static Application $clsApp;
    public string $sUserClass;
    public string $sLayout = 'main';
    public Database $clsDb;
    public Router $clsRouter;
    public Request $clsRequest;
    public Response $clsResponse;
    public ?Controller $clsController = null;
    public Session $clsSession;
    public ?UserModel $oUser;
    public View $clsView;
    

    public function __construct($sRootPath, array $aConfig) {
        $this->sUserClass = $aConfig['sUserClass'];
        self::$ROOT_DIR = $sRootPath;
        self::$clsApp = $this;
        $this->clsSession = new Session();
        $this->clsRequest = new Request();
        $this->clsResponse = new Response();
        $this->clsRouter = new Router($this->clsRequest, $this->clsResponse);
        $this->clsDb = new Database($aConfig['db']);
        $this->clsView = new View();

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
        try {
            echo $this->clsRouter->resolve();
        } catch (\Exception $e) {
            $this->clsResponse->setStatusCode($e->getCode());
            echo $this->clsView->renderView('_error', ['oException' => $e]);
        }
        
    }

    public function login(UserModel $oUser) {
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