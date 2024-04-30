<?php

namespace app\models;

use app\core\db\DbModel;

class FamilyHistoryDetails extends DbModel
{

    public string $MotherId = '';
    public string $diabetes1 = '1';
    public string $hypertension1 = '1';
    public string $haematological1 = '1';
    public string $other1 = '';

    public function rules(): array
    {
        return [
            'diabetes1' => [self::RULE_REQUIRED],
            'hypertension1' => [self::RULE_REQUIRED],
            'haematological1' => [self::RULE_REQUIRED],
        ];
    }

    public function tableName(): string
    {
        return 'FamilyHistoryDetails';
    }

    public function primaryKey(): string
    {
        return 'MotherId';
    }

    public function attributes(): array
    {
        return [

            'diabetes1',
            'hypertension1',
            'haematological1',
            'other1',




        ];
    }
}