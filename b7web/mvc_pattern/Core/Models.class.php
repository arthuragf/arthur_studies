<?php
namespace Core;

class Models {

    protected $oDb;

    public function __construct() {
        global $oDb;

        $this->oDb = $oDb;

    }

}