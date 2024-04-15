<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use PDO;

class Mother extends DbModel
{
    public string $MotherId = '';
    public string $user_id = '';
    public string $PHM_ID = '';
    public string $MaritalStatus  = 'Married';
    public string $MarriageDate ='';
    public string $BloodGroup = '';
    public string $DeliveryDate = '';
    public string $Occupation = '';
    public string $Allergies = '';
    public string $Consanguinity = '';
    public string $history_subfertility = '';
    public int $Hypertension = 1;
    public int $diabetes_mellitus = 1;
    public int $rubella_immunization = 1;
    public string $emergencyNumber = '';
    public string $nic = '';
    public string $clinic_id = '';
    public int $status = 1;
    public int $MotherStatus = 1;

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
            'DeliveryDate',
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
            'MotherStatus'
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
//            $exitUser = (new Mother())->getUser($ValidateUser->getId());
//            if($exitUser){
//                $this->addError('nic', 'That user is already a Mother');
//                return false;
//            }

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
            ];
        }
        return json_encode($data);
    }

    public function getMotherId()
    {
        $UserId = Application::$app->user->getId();
        $MotherData = self::findOne(Mother::class, ['user_id' => $UserId]);
        return $MotherData->MotherId;
    }

    public function getDeliveryDate()
    {
        $MotherId = (new Mother())->getMotherId();
       $MotherData = self::findOne(Mother::class, ['MotherId'=> $MotherId]);
       if ($MotherData) {
           return json_encode($MotherData->DeliveryDate);
       }else{
           return json_encode('null');
       }
    }

    public function getMidwifeContact() {
        $MotherId = (new Mother())->getMotherId();

        $sql = self::prepare("SELECT U.firstname, U.lastname, U.email, U.contact_no
                         FROM users AS U, midwife AS Mi, Mothers AS Mo
                         WHERE Mo.MotherId = :motherId AND Mo.clinic_id = Mi.clinic_id AND Mi.user_id = U.id");

        $sql->bindValue(":motherId", $MotherId);
        $sql->execute();

        // Fetch all rows as associative arrays
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Return the result as JSON
        return json_encode($result);
    }

}
