<?php
namespace app\core;
class Response {
    public function setStatusCode(int $nCode) {
        http_response_code($nCode);
    }
}