<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class Doctor extends Model
{
    public string $MOH_id = '';
    public string $nic = '';
    public string $SLMC_no = '';
    public string $clinic_id = '';

    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'SLMC_no' => [self::RULE_REQUIRED],
        ];
    }
}