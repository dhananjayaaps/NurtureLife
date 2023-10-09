<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class AddDoctor extends Model
{
    public string $nic = '';
    public string $clinic = '';

    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'clinic' => [self::RULE_REQUIRED],
        ];
    }
}