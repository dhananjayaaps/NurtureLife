<?php

namespace app\models;

use app\core\db\DbModel;

class Immunization extends DbModel
{
    public int $child_id ;
    public string $BatchNo1 = '';
    public string $Effects1 = '';


    public function tableName(): string
    {
        return 'Immunization';
    }

    public function attributes(): array
    {
        return [
            'BatchNo1',
            'Effects1'
        ];
    }

    public function primaryKey(): string
    {
        return 'child_id';
    }

    public function rules(): array
    {
        return [
            'BatchNo1' => [self::RULE_REQUIRED],
            'Effects1' => [self::RULE_REQUIRED],

        ];
    }
}