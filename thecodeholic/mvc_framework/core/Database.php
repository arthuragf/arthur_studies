<?php
namespace app\core;

class Database {
    public \PDO $oPdo;
    public function __construct(array $aConfig) {
        $sDsn = $aConfig['sDsn'] ?? '';
        $sUser = $aConfig['sUser'] ?? '';
        $sPassword = $aConfig['sPassword'] ?? '';
        $this->oPdo = new \PDO($sDsn, $sUser, $sPassword);
        $this->oPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    private function createMigrationsTable() {
        $this->oPdo->exec('CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;');
    }

    public function applyMigrations() {
        $this->createMigrationsTable();
        $aFiles = scandir(Application::$ROOT_DIR . '/migrations');
        $aAppliedMigrations = $this->getAppliedMigrations();
        $aToApplyMigrations = array_diff($aFiles, $aAppliedMigrations);
        
        foreach ($aToApplyMigrations as $sMigration) {
            if ($sMigration === '.' || $sMigration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $sMigration;
            $sClsName = pathinfo($sMigration, PATHINFO_FILENAME);
            $oInstance = new $sClsName();
            echo 'applying migration' . $sMigration . PHP_EOL;
            $oInstance->up();
            echo 'applied migration' . $sMigration . PHP_EOL;

            
        }
    }

    private function getAppliedMigrations() {
        $oSql = $this->oPdo->prepare('SELECT migration FROM migrations');

        return $oSql->fetchAll(\PDO::FETCH_COLUMN);
    }
}