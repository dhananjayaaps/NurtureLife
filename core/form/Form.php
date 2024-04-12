<?php

namespace app\core\form;

use app\core\Model;
use Cassandra\Date;

class Form
{
    public static function begin($action, $method): Form
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end(): string
    {
        return '</form>';
    }

    public function field(Model $model, $attribute, $name): InputField
    {
        return new InputField($model, $attribute, $name);
    }

    public function dateField(Model $model, $attribute, $name): DateField
    {
        return new DateField($model, $attribute, $name);
    }
}