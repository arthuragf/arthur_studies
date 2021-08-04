<?php
namespace app\core;

abstract class Model {

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public array $aErrors = [];

    public function loadData($aData) {
        foreach ($aData as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function validate() {
        foreach ($this->rules() as $sAttribute => $aRules) {
            $sValue = $this->{$sAttribute};
            foreach ($aRules as $rule) {
                $sRuleName = $rule;
                
                if (!is_string($sRuleName)) {
                    $sRuleName = $rule[0];
                }
            
                if ($sRuleName === self::RULE_REQUIRED && empty($sValue)) {
                    $this->addError($sAttribute, self::RULE_REQUIRED);
                }

                if ($sRuleName === self::RULE_EMAIL && !filter_var($sValue, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($sAttribute, self::RULE_EMAIL);
                }

                if ($sRuleName === self::RULE_MIN && strlen($sValue) < $rule['min']) {
                    $this->addError($sAttribute, self::RULE_MIN, $rule);
                }

                if ($sRuleName === self::RULE_MAX && strlen($sValue) > $rule['max']) {
                    $this->addError($sAttribute, self::RULE_MAX, $rule);
                }

                if ($sRuleName === self::RULE_MATCH && $sValue !== $this->{$rule['match']}) {
                    $this->addError($sAttribute, self::RULE_MATCH, $rule);
                }
            }
        }
        return empty($this->aErrors);
    }

    public function addError(string $sAttribute, string $sRule, $aParams = []) {
        $sMessage = $this->errorMessages()[$sRule] ?? '';
        foreach ($aParams as $key => $value) {
            $sMessage = str_replace("{{$key}}", $value, $sMessage);
        }
        $this->aErrors[$sAttribute][] = $sMessage;
    }

    public function errorMessages() {
        return [
            self::RULE_REQUIRED => 'This field is required'
            , self::RULE_EMAIL => 'This field must be valid email adress'
            , self::RULE_MIN => 'Min Length of this field must be {min}'
            , self::RULE_MAX => 'Max Length of this field must be {max}'
            , self::RULE_MATCH => 'This field must be the same as {match}'
        ];
    }
}