<?php
namespace app\models;
use app\core\Model;

class RegisterModel extends Model {
    public string $sFirstName = '';
    public string $sLastName = '';
    public string $sEmail = '';
    public string $sPassword = '';
    public string $sConfirmPassword = '';

    public function register() {
        return 'Creating a new user';
    }

    public function rules(): array {
        return [
            'sFirstName' => [self::RULE_REQUIRED]
            , 'sLastName' => [self::RULE_REQUIRED]
            , 'sEmail' => [self::RULE_REQUIRED, self::RULE_EMAIL]
            , 'sPassword' => [
                self::RULE_REQUIRED
                , [self::RULE_MIN, 'min' => 8]
                , [self::RULE_MAX, 'max' => 24]
            ]
            , 'sConfirmPassword' =>[self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'sPassword']]
        ];
    }



}