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
            $checked = $this->model->{$this->attribute} == $value ? 'checked' : '';
            $optionsHtml .= sprintf(
                '<div><input type="radio" name="%s" value="%s" %s>%s</div>',
                $this->attribute,
                $value,
                $checked,
                $label
            );
        }

        return $optionsHtml;
    }
}
