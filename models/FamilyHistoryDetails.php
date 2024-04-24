<?php

namespace app\models;

use app\core\db\DbModel;

class FamilyHistoryDetails extends DbModel
{

    public string $user_id = '';

    public string $nic = '';
    public string $MotherId = '';
    public string $PHM_ID = '';
    public string $diabetes1 = '';
    public string $hypertension1 = '';
    public string $haematological1 = '';
    public string $other1 = '';

    public function rules(): array
    {
        return [

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