<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class PresentObstetricDetails extends DbModel
{
    public int $MotherId;
    public string $gravidity = '';
    public int $no_of_children = 0 ;
    public int $age_of_youngest_child = 0;
    public string $lrmp = '';
    public string $edd = '';
    public string $us_corrected_edd = '';
    public string $expected_period = '';
    public string $POA_at_registration = '';
    public string $consanguinity = '1';
    public string $rubella_immunization = '1';
    public string $pre_pregancy_screening_done = '1';
    public string $folic_acid = '1';

    public function rules(): array
    {
        return [
            'gravidity' => [self::RULE_REQUIRED],
            'no_of_children' => [self::RULE_REQUIRED],
            'age_of_youngest_child' => [self::RULE_REQUIRED],
            'lrmp' => [self::RULE_REQUIRED],
            'edd' => [self::RULE_REQUIRED],
            'us_corrected_edd' => [self::RULE_REQUIRED],
            'expected_period' => [self::RULE_REQUIRED],
            'POA_at_registration' => [self::RULE_REQUIRED],
            'consanguinity' => [self::RULE_REQUIRED],
            'rubella_immunization' => [self::RULE_REQUIRED],
            'pre_pregancy_screening_done' => [self::RULE_REQUIRED],
            'folic_acid' => [self::RULE_REQUIRED],

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

    public function getMotherId(): string
    {
        $UserId = Application::$app->user->getId();
        $MotherData = self::findOne(Mother::class, ['user_id' => $UserId]);
        return $MotherData->MotherId;
    }
    public function save(): bool
    {
        $this->MotherId = $this->getMotherId();
//        var_dump($this);
//        exit();
        return parent::save();
    }
}
