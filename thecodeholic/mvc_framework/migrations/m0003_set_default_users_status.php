<?php
class m0003_set_default_users_status {
    public app\core\Database $clsDb;

    public function __construct (app\core\Database $clsDb) {
        $this->clsDb = $clsDb;
    }
    
    public function up() {
        $this->clsDb->oPdo->exec('
            ALTER TABLE users ALTER status SET DEFAULT 0
        ');
    }

    public function down() {
        $this->clsDb->oPdo->exec('
            ALTER TABLE users ALTER status DROP DEFAULT
        ');
    }
}