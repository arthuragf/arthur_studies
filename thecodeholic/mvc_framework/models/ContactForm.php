<?php

namespace app\models;

use app\core\Model;
use app\core\Application;

class ContactForm extends Model {
    public string $sSubject = '';
    public string $sEmail = '';
    public string $sBody = '';

    public function rules(): array {
        return [
            'sSubject' => [self::RULE_REQUIRED],
            'sEmail' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'sBody' => [self::RULE_REQUIRED]
        ];
    }

    public function send() {
        return true;
    }

    public function labels(): array {
        return [
            'sEmail' => 'Your email'
            , 'sSubject' => 'Enter your subject'
            , 'sBody' => 'Body'
        ];
    }
}