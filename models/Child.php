<?php

namespace app\models;

use app\core\db\DbModel;

class Child extends DbModel
{

    public string $user_id = '';
    public string $PHM_ID = '';
    public string $Clinic_ID = '';
    public string $nic = '';
    public string $Child_Name = '';
    public string $Register_NO = '';
    public string $Birth_Date = '';
    public string $Birth_Place = '';
    public string $Mother_Name = '';
    public string $Age = '';
    public string $Address = '';



    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'PHM_ID' => [self::RULE_REQUIRED],
            'Clinic_ID' => [self::RULE_REQUIRED],
            'Birth_Date' => [self::RULE_REQUIRED],
            'Register_NO' => [self::RULE_REQUIRED],
            'Birth_Place' => [self::RULE_REQUIRED],
            'Mother_Name' => [self::RULE_REQUIRED],
            'Age' => [self::RULE_REQUIRED],
            'Address' => [self::RULE_REQUIRED],
            'Child_Name' => [self::RULE_REQUIRED],
        ];
    }

    public function tableName(): string
    {
        return 'mothers';
    }

    public function primaryKey(): string
    {
        return 'nic';
    }

    public function attributes(): array
    {
        return [
            'PHM_ID',
            'Clinic_ID',
            'nic',
            'Child_Name',
            'Register_NO',
            'Birth_Date',
            'Birth_Place',
            'Mother_Name',
            'Age',
            'Address',

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
            $exitPHM = (new Midwife())->findOne(Child::class, ["id" => $this->PHM_ID]);
            if(!$exitPHM){
                $this->addError('PHM_ID', 'That Clinic no exists');
                return false;
            }
            $this->user_id = $ValidateUser->id;
            return parent::save();
        }

    }

    private function getUser($id)
    {
        return (new Midwife())->findOne(Midwife::class, ['user_id' => $id]);
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
