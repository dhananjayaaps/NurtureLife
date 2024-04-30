<?php

namespace app\models;

use app\core\db\DbModel;

class PostMotherDetails extends DbModel
{
    public int $MotherId;
    public string $breast_problems = '1';
    public string $abnormal_vaginal_discharge = '1';
    public string $excessive_vaginal_bleeding = '1';
    public string $pallor = '1';
    public string $lcterus = '1';
    public string $dema = '1';
    public string $bp = '1';
    public string $cardiovascular_system = '1';
    public string $respiratory_system = '1';
    public string $abdominal_examination = '1';
    public string $mental_status = '1';
    public string $family_planning_method = '1';

    public function rules(): array
    {
        return [
            'breast_problems' => [self::RULE_REQUIRED],
            'abnormal_vaginal_discharge' => [self::RULE_REQUIRED],
            'excessive_vaginal_bleeding' => [self::RULE_REQUIRED],
            'pallor' => [self::RULE_REQUIRED],
            'lcterus' => [self::RULE_REQUIRED],
            'dema' => [self::RULE_REQUIRED],
            'bp' => [self::RULE_REQUIRED],
            'cardiovascular_system' => [self::RULE_REQUIRED],
            'respiratory_system' => [self::RULE_REQUIRED],
            'abdominal_examination' => [self::RULE_REQUIRED],
            'mental_status' => [self::RULE_REQUIRED],
            'family_planning_method' => [self::RULE_REQUIRED],

        ];
    }

    public function tableName(): string
    {
        return 'PostMotherDetails';
    }

    public function primaryKey(): string
    {
        return 'MotherId';
    }

    public function attributes(): array
    {
        return [
            'breast_problems',
            'abnormal_vaginal_discharge',
            'excessive_vaginal_bleeding',
            'pallor',
            'lcterus',
            'dema',
            'bp',
            'cardiovascular_system',
            'respiratory_system',
            'abdominal_examination',
            'mental_status',
            'family_planning_method',


        ];
    }
}