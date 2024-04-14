<?php

namespace app\models;

use app\core\db\DbModel;

class PreMotherDetails extends DbModel
{

    public string $user_id = '';

    public string $nic = '';
    public string $MotherId = '';
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
    public string $diabetes1 = '';
    public string $hypertension1 = '';
    public string $haematological1 = '';
    public string $other1 = '';
    public string $age = '';
    public string $education_level = '';
    public string $occuption = '';
    public string $age1 = '';
    public string $education_level1 = '';
    public string $occuption1 = '';
    public function rules(): array
    {
        return [

        ];
    }

    public function tableName(): string
    {
        return 'Mothers';
    }

    public function primaryKey(): string
    {
        return 'MotherId';
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'nic',
            'MotherId',
            'gravidity',
            'no_of_children',
            'age_of_youngest_child',
            'lrmp',
            'edd',
            'us_corrected_edd',
            'expected_period',
            'POA_at_registration',
//            'consanguinity',
            'rubella_immunization',
            'pre_pregancy_screening_done',
            'folic_acid',
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
            'diabetes1',
            'hypertension1',
            'haematological1',
            'other1',
            'age',
            'education_level',
            'occuption',
            'age1',
            'education_level1',
            'occuption1',



        ];
    }

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);

        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        } else {
            $exitUser = (new Mother())->getUser($ValidateUser->getId());


            $this->user_id = $ValidateUser->id;
            var_dump("errors", $this->errors);
            return parent::save();
        }
        return parent::save();

    }

}