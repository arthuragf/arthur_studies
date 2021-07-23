<?php
class User {
    private $id;
    private $name;
    private $email;

    public function getId() {
        return $this->id;
    }

    public function setId($nId) {
        $this->id = trim($nId);
    }

    public function getName() {
        return $this->name;
    }

    public function setName($sName) {
        $this->name = ucwords(trim($sName));
    }

    public function getEmail() {
        return $this->name;
    }

    public function setEmail($sEmail) {
        $this->name = strtolower(trim($sEmail));
    }
}

interface UserDAO {
    public function addUser(User $oUser);
    public function getUsers();
    public function getById($nId);
    public function editUser(User $oUser);
    public function deleteUser($nId);
}