<?php
require_once 'models/User.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class UserDaoMySql implements UserDAO {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function addUser(User $oUser) {
        $oSql = $this->pdo->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
        $oSql->bindValue(':name', $oUser->getName());
        $oSql->bindValue(':email', $oUser->getEmail());
        $oSql->execute();

        $oUser->setId($this->pdo->lastInsertId());

        return $oUser;
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
        $oUser = new stdClass();
        $oSql = $this->pdo->prepare('SELECT * FROM users where id = :id');
        $oSql->bindValue(':id', $nId);
        $oSql->execute();

        if($oSql->rowCount() > 0) {
            $aRs = $oSql->fetch();
            $oUser = new User();
            $oUser->setId($aRs['id']);
            $oUser->setName($aRs['name']);
            $oUser->setEmail($aRs['email']);
        }

        return $oUser;
    }

    public function getByEmail($sEmail) {
        $oUser = new stdClass();
        $oSql = $this->pdo->prepare('SELECT * FROM users where email = :email');
        $oSql->bindValue(':email', $sEmail);
        $oSql->execute();

        if($oSql->rowCount() > 0) {
            $aRs = $oSql->fetch();
            $oUser->setId($aRs['id']);
            $oUser = new User();
            $oUser->setEmail($aRs['email']);
            $oUser->setName($aRs['name']);
        }

        return $oUser;
    }

    public function editUser(User $oUser) {
        
        $oSql = $this->pdo->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
        $oSql->bindValue(':id', $oUser->getId());
        $oSql->bindValue(':name', $oUser->getName());
        $oSql->bindValue(':email', $oUser->getEmail());
        $ok = $oSql->execute();
        } 
    
    public function deleteUser($nId) {
        $oSql = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        $oSql->bindValue(':id', $nId);
        $oSql->execute();
    }
}