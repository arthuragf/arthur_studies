<?php
namespace app\core\form;
use app\core\Model;

class Form {
    public static function begin($sAction, $sMethod) {
        echo sprintf('<form action="%s" method="%s">', $sAction, $sMethod);
        return new Form();
    }

    public static function end() {
        echo '</form>';
    }

    public function field(Model $clsModel, $sAttribute) {
        return new Field ($clsModel, $sAttribute);

    }
}