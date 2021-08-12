<?php
namespace app\core;
abstract class DbModel extends Model {
    abstract public function getTableName(): string;

    abstract public function getAttributes(): array;

    public function save() {
        $sTableName = $this->getTableName();
        $aAttributes = $this->getAttributes();
        $aParams = array_map(fn($v) => ':' . $v, $aAttributes);
        $oSql = self::prepare('INSERT INTO ' . $sTableName . '(' 
            . implode(', ', $aAttributes) 
            . ') VALUES (' 
            . implode(', ', $aParams) . ')');
        
        foreach ($aAttributes as $sAttribute)
            $oSql->bindValue(':' . $sAttribute, $this->{$sAttribute});            
        
        $oSql->execute();
        return true;
    }

    public static function prepare($sSql) {
        return Application::$clsApp->clsDb->oPdo->prepare($sSql);
    }

}