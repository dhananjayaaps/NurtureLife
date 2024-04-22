<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class PresentObstetricDetails extends DbModel
{
    public string $MotherId = '';
    public string $user_id = '';
    public string $PHM_ID = '';
    public string $gravidity = '';
    public string $no_of_children = '';
    public string $age_of_youngest_child = '';
    public string $lrmp = '';
    public string $edd = '';
    public string $us_corrected_edd = '';
    public string $expected_period = '';
    public string $POA_at_registration = '';
    public string $consanguinity = '';
    public string $rubella_immunization = '';
    public string $pre_pregancy_screening_done = '';
    public string $folic_acid = '';

    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'MaritalStatus' => [self::RULE_REQUIRED],
            'BloodGroup' => [self::RULE_REQUIRED],
            'rubella_immunization' => [self::RULE_REQUIRED],
            'emergencyNumber' => [self::RULE_REQUIRED]
        ];
    }

    public function tableName(): string
    {
        return 'PreMotherHistoryDetails';
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
