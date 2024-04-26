<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Mother extends DbModel
{
    public string $MotherId = '';
    public string $user_id = '';
    public string $PHM_ID = '';
    public string $MaritalStatus  = 'Married';
    public string $MarriageDate ='';
    public string $BloodGroup = '';
    public string $Occupation = '';
    public string $Allergies = '';
    public string $Consanguinity = '1';
    public string $history_subfertility = '1';
    public string $Hypertension = '1';
    public string $diabetes_mellitus = '1';
    public string $rubella_immunization = '1';
    public string $emergencyNumber = '';
    public string $DeliveryDate = '';
    public string $nic = '';
    public string $clinic_id = '';
    public int $status = 1;
    public int $MotherStatus = 1;
    public string $location= '';

    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'MaritalStatus' => [self::RULE_REQUIRED],
            'BloodGroup' => [self::RULE_REQUIRED],
            'rubella_immunization' => [self::RULE_REQUIRED],
            'emergencyNumber' => [self::RULE_REQUIRED],
            'Consanguinity' => [self::RULE_REQUIRED],
            'history_subfertility' => [self::RULE_REQUIRED],
            'Hypertension' => [self::RULE_REQUIRED],
            'diabetes_mellitus' => [self::RULE_REQUIRED],
            'location' => [self::RULE_REQUIRED],
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
            'PHM_ID',
            'MaritalStatus',
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
            'clinic_id',
            'MotherStatus',
            'DeliveryDate',
            'location'
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

            $exitPHM = (new Midwife())->findOne(Midwife::class, ["user_id" => Application::$app->user->getId()]);
            if(!$exitPHM){
                $this->addError('PHM_ID', 'That Clinic no exists');
                return false;
            }
            $this->MotherStatus = 1;
            $this->PHM_ID = $exitPHM->PHM_id;
            $this->user_id = $ValidateUser->id;
            $this->clinic_id = $exitPHM->clinic_id;
            $this->status = 1;
            return parent::save();
        }
    }

    public function getUser($id)
    {
        return (new Mother())->findOne(Mother::class, ['user_id' => $id]);
    }

    public function getMothers(): string
    {
        $joins = [
            ['model' => User::class, 'condition' => 'Mothers.user_id = users.id'],
            ['model' => Midwife::class, 'condition' => 'Mothers.PHM_ID = midwife.PHM_id']
        ];

        $motherData = (new Mother())->findAllWithJoins(self::class, $joins);

        $data = [];
        $StatusNames = ['Inactive', 'Prenatal', 'Postnatal', 'Both' ,'Special'];

        foreach ($motherData as $mother) {
            $data[] = [
                'MotherId' => $mother->MotherId,
                'Name' => $mother->firstname . " " . $mother->lastname,
                'Status' => $StatusNames[(int)$mother->MotherStatus],
                'DeliveryDate' => $mother->DeliveryDate,
                'PHM_id' => $mother->PHM_ID,
//                'PHM_Name' => (new Midwife())->findOne(self::class, ['PHM_id'=> $mother->PHM_ID ] )->firstname . " " . (new Midwife())->findOne(self::class, ['PHM_id'=> $mother->PHM_ID ] )->lastname
            ];
        }
        return json_encode($data);
    }

}
