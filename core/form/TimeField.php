<?php

namespace app\core\form;

use app\core\Model;

class TimeField extends BaseField
{
    public const TYPE_TIME = 'time';
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
        $this->type = self::TYPE_TIME;
        parent::__construct($model, $attribute, $name);
    }

    public function readOnlyField(): TimeField
    {
        $this->readOnly = self::READ_ONLY;
        return $this;
    }

    public function renderInput(): string
    {
        $value = $this->model->{$this->attribute} ?? date("H:i");

        return sprintf('<input type="%s" name="%s" value="%s" %s class="form-control %s">',
            $this->type,
            $this->attribute,
            $value,
            $this->readOnly ? 'readonly' : '',
            $this->model->hasError($this->attribute) ? ' is-invalid' : ''
        );
    }
}
