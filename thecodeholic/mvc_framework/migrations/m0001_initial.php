<?php
class m0001_initial {
    public app\core\Database $clsDb;

    public function __construct (app\core\Database $clsDb) {
        $this->clsDb = $clsDb;
    }
    
    public function up() {
        $this->clsDb->oPdo->exec('
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                status TINYINT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        ');
    }

    public function down() {
        $this->clsDb->oPdo->exec('
            DROP TABLE users;
        ');
    }
}