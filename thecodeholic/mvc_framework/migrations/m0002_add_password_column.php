<?php
class m0002_add_password_column {
    public app\core\Database $clsDb;

    public function __construct (app\core\Database $clsDb) {
        $this->clsDb = $clsDb;
    }

    public function up() {
        $this->clsDb->oPdo->exec('
            ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;
        ');
    }

    public function down() {
        $this->clsDb->oPdo->exec('
            ALTER TABLE users DROP COLUMN password;
        ');
    }
}