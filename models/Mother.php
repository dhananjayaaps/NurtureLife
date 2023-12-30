<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Mother extends DbModel
{
    public string $MotherId = '';
    public string $user_id = '';
    public string $PHM_ID = '';
    public string $MartialStatus  = 'Married';
    public string $MarriageDate ='';
    public string $BloodGroup = '';
    public string $Occupation = '';
    public string $Allergies = '';
    public string $Consanguinity = '';
    public string $history_subfertility = '';
    public string $Hypertension = '';
    public string $diabetes_mellitus = '';
    public string $rubella_immunization = 'Yes';
    public string $emergencyNumber = '';
    public string $nic = '';
    public string $clinic_id = '';

    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'MartialStatus' => [self::RULE_REQUIRED],
            'BloodGroup' => [self::RULE_REQUIRED],
            'rubella_immunization' => [self::RULE_REQUIRED],
            'emergencyNumber' => [self::RULE_REQUIRED]
        ];
    }

    public function tableName(): string
    {
        return 'mothers';
    }

    public function primaryKey(): string
    {
        return 'MotherId';
    }

    public function attributes(): array
    {
        return [
            'PHM_ID',
            'MartialStatus',
            'MarriageDate',
            'BloodGroup',
            'Occupation',
            'Allergies',
            'Consanguinity',
            'history_subfertility',
            'Hypertension',
            'diabetes_mellitus',
            'rubella_immunization',
            'emergencyNumber',
            'user_id',
            'clinic_id'
        ];
    }

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);

        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        }
        else{
            $exitUser = (new Mother())->getUser($ValidateUser->getId());
            if($exitUser){
                $this->addError('nic', 'That user is already a Mother');
                return false;
            }

            $exitPHM = (new Midwife())->findOne(Midwife::class, ["user_id" => Application::$app->user->getId()]);
            if(!$exitPHM){
                $this->addError('PHM_ID', 'That Clinic no exists');
                return false;
            }
            $this->PHM_ID = $exitPHM->PHM_id;
            $this->user_id = $ValidateUser->id;
            $this->clinic_id = $exitPHM->clinic_id;
            return parent::save();
        }
    }

    private function getUser($id)
    {
        return (new Mother())->findOne(Mother::class, ['user_id' => $id]);
    }

//
//    public function getMothers(): string
//    {
//        // Implement a method to get a list of mothers similar to the getMidwifes method
//        // Fetch data from the database and format it as needed
//        // Return data in JSON format as shown in the getMidwifes method.
//    }
//
//    public function getMotherById($MotherId): string
//    {
//        // Implement a method to get mother details by ID
//        // Fetch data from the database based on MotherId and return it in JSON format.
//    }
//
//    public function getAMother($MotherId)
//    {
//        // Implement a method to get a single mother by ID similar to getAMidwife
//        // Fetch data from the database and return it, or return null if not found.
//    }
//
//    public function update(): bool
//    {
//        // Implement the update logic similar to the Midwife class
//        // Add validation, checks, and database updating logic
//        // Ensure you return true if the update is successful, and false if it fails.
//    }

    // Add any additional methods you need for the Mother module here
}
