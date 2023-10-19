<?php

namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const READ_ONLY = 'readonly';
    public string $type;
    public string $name;
    public Model $model;
    public string $attribute;
    private $readOnly;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute, $name)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute, $name);
    }

    public function passwordField(): InputField
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function readOnlyField(): InputField
    {
        $this->readOnly = self::READ_ONLY;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s" %s class="form-control %s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->readOnly ? 'readonly' : '',
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        );
    }
}
