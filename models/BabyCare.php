<?php

namespace app\models;

use app\core\db\DbModel as parentAlias;

class BabyCare extends parentAlias
{
    public int $child_id ;
    public string $no_of_apga ='1';
    public string $birth_weight = '';
    public string $head_circumference_at_birth = '';
    public string $baby_length_at_birth = '';
    public string $health_condition = '1';
    public string $vitamin_k= '1';

    public function rules(): array
    {
        return [
            'no_of_apga' => [self::RULE_REQUIRED],
            'birth_weight' => [self::RULE_REQUIRED],
            'head_circumference_at_birth' => [self::RULE_REQUIRED],
            'baby_length_at_birth' => [self::RULE_REQUIRED],
            'health_condition' => [self::RULE_REQUIRED],
            'vitamin_k' => [self::RULE_REQUIRED],

        ];
    }

    public function tableName(): string
    {
        return 'BabyCare';
    }

    public function primaryKey(): string
    {
        return 'child_id';
    }

    public function attributes(): array
    {
        return [
            'no_of_apga',
            'birth_weight',
            'head_circumference_at_birth',
            'baby_length_at_birth',
            'health_condition',
            'vitamin_k',
        ];
    }

//    public function save(): bool
//    {
//        $this->child_id = $this->getChildId();
//        return parent::save();
//    }
//
//    public function getChildId(): string
//    {
//        return "1";
//    }
}
