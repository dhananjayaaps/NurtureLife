<?php

namespace app\models;

use app\core\db\DbModel;

class MedicalSurgicalDetails extends DbModel
{

    public string $MotherId = '';
    public string $user_id = '';
    public string $PHM_ID = '';
    public string $diabetes = '';
    public string $hypertension = '';
    public string $cardiac_diseases = '';
    public string $renal_diseases = '';
    public string $hepatic_diseases = '';
    public string $psychiatric_illnesses = '';
    public string $epilepsy = '';
    public string $malignancies = '';
    public string $haematological_diseases = '';
    public string $tuberculosis = '';
    public string $thyroid_diseases = '';
    public string $bronchial_asthma = '';
    public string $previous_dtv = '';
    public string $surgeries = '';
    public string $social_risk = '';
    public string $other = '';


    public function rules(): array
    {
        return [

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