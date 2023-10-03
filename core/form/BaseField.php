<?php

namespace app\core\form;

use app\core\Model;

abstract class BaseField
{

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute, $name)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->name = $name;
    }

    abstract public function renderInput(): string;

    public function __toString()
    {
        $value = $this->model->{$this->attribute} ?? '';
        $hasError = $this->model->hasError($this->attribute);
        $class = $hasError ? ' is-invalid' : '';

        return sprintf(
            '
        <div class="form-group">
            <label>%s</label>
            %s
            <div class="invalid-feedback">
                %s
                %s
            </div>
        </div>
        ',
            $this->name,
            $this->renderInput(),
            $this->model->getFirstError($this->attribute) ? "<svg aria-hidden=\"true\" class=\"stUf5b qpSchb\" fill=\"currentColor\" focusable=\"false\" width=\"16px\" height=\"16px\" viewBox=\"0 0 24 24\" xmlns=\"https://www.w3.org/2000/svg\"><path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z\"></path></svg>" : '',
            $this->model->getFirstError($this->attribute),
        );
    }
}