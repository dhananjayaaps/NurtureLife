<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public string $type;
    public string $name;
    public Model $model;
    public string $attribute;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute, $name)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->name = $name;
    }

    public function __toString()
    {
        $value = $this->model->{$this->attribute};
        $hasError = $this->model->hasError($this->attribute);
        $class = $hasError ? ' is-invalid' : '';

        return sprintf(
            '
        <div class="form-group">
            <label>%s</label>
            <input type="%s" name="%s" value="%s" class="form-control %s">
            <div class="invalid-feedback">
                %s
            </div>
        </div>
        ',
            $this->name,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}