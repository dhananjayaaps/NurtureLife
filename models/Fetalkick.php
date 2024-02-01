<?php

namespace app\models;

use app\core\db\DbModel;

class Fetalkick extends DbModel
{
    public string $RecordId ='';
    public string $MotherId ='';
    public string $KickCount ='';

    public function rules(): array
    {
        return[

            'KickCount'=> [self::RULE_REQUIRED]

        ];
    }

    public function tableName(): string
    {
        return 'fetalKick';
    }

    public function primaryKey(): string
    {
        return 'RecordId';
    }

    public function attributes(): array
    {
       return [
            'MotherId',
            'KickCount'
           ];
    }
}