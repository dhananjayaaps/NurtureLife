<?php

namespace app\models;

use app\core\db\DbModel as parentAlias;

class BabySpecialCare extends parentAlias
{
    public int $child_id ;
    public string $premature_births= '1';
    public string $low_birth_weight= '1';
    public string $neonatal_complications= '1';
    public string $congenital_disorders= '1';
    public string $acute_conditions= '1';
    public string $complementary_feeding= '1';
    public string $growth_retardation= '1';
    public string $difficulty_feeding= '1';
    public string $death_of_mother_or_father= '1';
    public string $migration_of_mother_or_father= '1';
    public string $other_reasons= '';

    public function rules(): array
    {
        return [
            'premature_births' => [self::RULE_REQUIRED],
            'low_birth_weight' => [self::RULE_REQUIRED],
            'neonatal_complications' => [self::RULE_REQUIRED],
            'congenital_disorders' => [self::RULE_REQUIRED],
            'acute_conditions' => [self::RULE_REQUIRED],
            'complementary_feeding' => [self::RULE_REQUIRED],
            'growth_retardation' => [self::RULE_REQUIRED],
            'difficulty_feeding' => [self::RULE_REQUIRED],
            'death_of_mother_or_father' => [self::RULE_REQUIRED],
            'migration_of_mother_or_father' => [self::RULE_REQUIRED],

        ];
    }

    public function tableName(): string
    {
        return 'BabySpecialCare';
    }

    public function primaryKey(): string
    {
        return 'child_id';
    }

    public function attributes(): array
    {
        return [
            'premature_births',
            'low_birth_weight',
            'neonatal_complications',
            'congenital_disorders',
            'acute_conditions',
            'complementary_feeding',
            'growth_retardation',
            'difficulty_feeding',
            'death_of_mother_or_father',
            'migration_of_mother_or_father',
            'other_reasons',
        ];
    }

    public function save(): bool
    {
        $this->child_id = $this->getChildId();
        return parent::save();
    }

    public function getChildId(): string
    {
        return "1";
    }

}
