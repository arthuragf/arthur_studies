<?php
require_once 'models/User.php';

class UserDaoMySql implements UserDAO {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function addUser(User $oUser) {

    }
    public function getUsers() {
        $aRet = [];
        $aUsers = [];
        $oSql = $this->pdo->query('SELECT * FROM users');
        if($oSql->rowCount() > 0) {
            $aUsers = $oSql->fetchAll();           
            foreach($aUsers as $aItem) {
                $clsUser = new User();
                $clsUser->setId($aItem['id']);
                $clsUser->setName($aItem['name']);
                $clsUser->setEmail($aItem['email']);

                $aRet[] = $clsUser;
            }
        }
        return $aRet;
    }
    public function getById($nId) {

    }
    public function editUser(User $oUser) {

    }
    public function deleteUser($nId) {

    }
}