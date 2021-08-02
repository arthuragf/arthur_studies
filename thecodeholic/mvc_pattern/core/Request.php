<?php
namespace app\core;
class Request {
    public function getPath() {
        $sPath = $_SERVER['REQUEST_URI'] ?? '/';
        $nPosition = strpos($sPath, '?');

        if ($nPosition === false) {
            return $sPath;
        }

        return substr($sPath, 0, $nPosition);
    }

    public function getMethod() {
            return strtolower($_SERVER['REQUEST_METHOD']);
    }
}