<?php

namespace app\core\form;

class RadioButton extends BaseField
{

    public function __construct($model, $attribute, $name)
    {
        parent::__construct($model, $attribute, $name);
    }
    public function renderInput(): string
    {
        return sprintf('<input type="radio" name="%s" value="%s" %s class="form-control %s">',
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        );
    }
}