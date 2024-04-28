<?php

namespace app\core\form;

use app\core\Model;

class RadioButton extends BaseField
{
    public const TYPE_RADIO = 'radio';
    public string $type;
    public string $name;
    public Model $model;
    public string $attribute;
    private array $options = [];
    private bool $readOnly = false;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute, $name)
    {
        $this->type = self::TYPE_RADIO;
        parent::__construct($model, $attribute, $name);
    }

    public function setOptions(array $options): RadioButton
    {
        $this->options = $options;
        return $this;
    }

    public function renderInput(): string
    {
        $optionsHtml = '';

        foreach ($this->options as $value => $label) {
            $selected = $this->model->{$this->attribute} == $value ? 'selected' : '';
            $optionsHtml .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $label);
        }

        return sprintf('<select name="%s" class="form-control %s" %s>%s</select>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->readOnly ? 'readonly' : '',
            $optionsHtml
        );
    }
}
