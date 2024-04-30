<?php

namespace app\models;

use app\core\db\DbModel;

class MedicalSurgicalDetails extends DbModel
{

    public int $MotherId ;
    public string $diabetes = '1';
    public string $hypertension = '1';
    public string $cardiac_diseases = '1';
    public string $renal_diseases = '1';
    public string $hepatic_diseases = '1';
    public string $psychiatric_illnesses = '1';
    public string $epilepsy = '1';
    public string $malignancies = '1';
    public string $haematological_diseases = '1';
    public string $tuberculosis = '1';
    public string $thyroid_diseases = '1';
    public string $bronchial_asthma = '1';
    public string $previous_dtv = '1';
    public string $surgeries = '1';
    public string $social_risk = '1';
    public string $other = '';


    public function rules(): array
    {
        return [
            'diabetes' => [self::RULE_REQUIRED],
            'hypertension' => [self::RULE_REQUIRED],
            'cardiac_diseases' => [self::RULE_REQUIRED],
            'renal_diseases' => [self::RULE_REQUIRED],
            'hepatic_diseases' => [self::RULE_REQUIRED],
            'psychiatric_illnesses' => [self::RULE_REQUIRED],
            'epilepsy' => [self::RULE_REQUIRED],
            'malignancies' => [self::RULE_REQUIRED],
            'haematological_diseases' => [self::RULE_REQUIRED],
            'tuberculosis' => [self::RULE_REQUIRED],
            'thyroid_diseases' => [self::RULE_REQUIRED],
            'bronchial_asthma' => [self::RULE_REQUIRED],
            'previous_dtv' => [self::RULE_REQUIRED],
            'surgeries' => [self::RULE_REQUIRED],
            'social_risk' => [self::RULE_REQUIRED],

        ];
    }

    public function tableName(): string
    {
        return 'MedicalSurgicalDetails';
    }

    public function primaryKey(): string
    {
        return 'MotherId';
    }

    public function attributes(): array
    {
        return [

            'diabetes',
            'hypertension',
            'cardiac_diseases',
            'renal_diseases',
            'hepatic_diseases',
            'psychiatric_illnesses',
            'epilepsy',
            'malignancies',
            'haematological_diseases',
            'tuberculosis',
            'thyroid_diseases',
            'bronchial_asthma',
            'previous_dtv',
            'surgeries',
            'social_risk',
            'other',

        ];
    }


}