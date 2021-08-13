<?php
namespace app\core\form;
use app\core\Model;

class Field {
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public Model $clsModel;
    public string $sAttribute;
    public string $sType;

    public function __construct(Model $clsModel, string $sAttribute) {
        $this->clsModel = $clsModel;
        $this->sAttribute = $sAttribute;
        $this->sType = self::TYPE_TEXT;
    }

    public function __toString() {
        return sprintf('
            <div class="form-group mb-3">
                <label class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" class="form-control %s">
                <div class="invalid-feedback">%s</div>
            </div>
        '
            , $this->clsModel->getLabel($this->sAttribute)
            , $this->sType
            , $this->sAttribute
            , $this->clsModel->{$this->sAttribute}
            , $this->clsModel->hasError($this->sAttribute) ? ' is-invalid' : ''
            , $this->clsModel->getFirstError($this->sAttribute)
         
        );

    }
    public function passwordField() {
        $this->sType = self::TYPE_PASSWORD;
        return $this;
    }
}