<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class PresentObstetricDetails extends Mother
{
    public string $MotherId = '';
    public string $gravidity = '';
    public int $no_of_children = 0;
    public int $age_of_youngest_child = 0;
    public string $lrmp = '';
    public string $edd = '';
    public string $us_corrected_edd = '';
    public string $expected_period = '';
    public string $POA_at_registration = '';
    public string $consanguinity = '';
    public int $rubella_immunization = 0;
    public string $pre_pregancy_screening_done = '';
    public string $folic_acid = '';

    public function rules(): array
    {
        return [
            'premature_births' => [self::RULE_REQUIRED],

        ];
    }

    public function tableName(): string
    {
        return 'PresentObstetricDetails';
    }

    public function primaryKey(): string
    {
        return 'MotherId';
    }

    public function attributes(): array
    {
        return [

            'gravidity',
            'no_of_children',
            'age_of_youngest_child',
            'lrmp',
            'edd',
            'us_corrected_edd',
            'expected_period',
            'POA_at_registration',
           'consanguinity',
            'rubella_immunization',
            'pre_pregancy_screening_done',
            'folic_acid',
        ];
    }
}
