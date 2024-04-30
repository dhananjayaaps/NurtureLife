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

            $userRole = new UserRoles();
            $userRole->role_id = User::ROLE_PRE_MOTHER;
            $userRole->user_id = $ValidateUser->id;
            $userRole->save();

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

    public function getDailyRegistrationCount()
    {
        $statement = self::prepare("SELECT DATE(Created_At) AS Registration_Date, COUNT(*) AS Registration_Count FROM Mothers GROUP BY DATE(Created_At) ORDER BY DATE(Created_At) ASC");
        $statement->execute();
        return json_encode($statement->fetchAll(PDO::FETCH_OBJ));
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
    public function getMotherClinic()
    {
        $UserId = Application::$app->user->getId();
        $MotherData = self::findOne(Mother::class, ['user_id' => $UserId]);
        return $MotherData->clinic_id;
    }
    public function getClinicDoctors()
    {
        $clinic = (new Mother())->getMotherClinic();

        $sql = self::prepare("SELECT D.MOH_id , U.firstname, U.lastname
                     From doctors AS D, users AS U
                     WHERE D.user_id = U.id AND D.clinic_id = :clinicId");

        $sql->bindValue(":clinicId", $clinic);
        $sql->execute();

        // Fetch all rows as associative arrays
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Return the result as JSON
        return json_encode($result);
    }

    public function getMotherCountForAdmin()
    {
        // Get the current month
        $currentMonth = date('n');

        $sql = "SELECT COUNT(*) AS Registration_Count, MONTH(Created_At) AS Registration_Month FROM Mothers WHERE Created_At BETWEEN DATE_SUB(NOW(), INTERVAL 12 MONTH) AND NOW() GROUP BY MONTH(Created_At)";
        $statement = self::prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $data = array_fill(0, 12, 0);
        $index = $currentMonth;

        foreach ($result as $item) {
            $monthIndex = $index % 12;
            $data[$monthIndex] = $item->Registration_Count;
            $index++;
        }
        return json_encode($data);
    }

    //i need to get all details of the mother
    public function getMotherDetails($MotherId)
    {
        $sql = "SELECT m.MotherId, m.user_id, m.PHM_ID, m.clinic_id, m.MotherStatus, m.MaritalStatus, m.MarriageDate, m.BloodGroup, m.DeliveryDate, m.Occupation, m.Allergies, m.Consanguinity, m.history_subfertility, m.Hypertension, m.diabetes_mellitus, m.rubella_immunization, m.emergencyNumber, m.location, m.status AS MotherStatus, m.Created_At AS MotherCreated, u.id AS UserId, u.email, u.firstname, u.lastname, u.nic, u.status AS UserStatus, u.created_at AS UserCreated, u.contact_no, u.home_number, u.lane, u.city, u.postal_code, u.DOB, u.gender FROM Mothers m JOIN users u ON m.user_id = u.id WHERE m.MotherId = :MotherId";
        $statement = self::prepare($sql);
        $statement->bindValue(":MotherId", $MotherId);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    //get all childs names for a mother
    public function getMotherChildren($MotherId)
    {
        $motherUserId = (new Mother())->findOne(Mother::class, ['MotherId' => $MotherId])->user_id;
        $sql = "SELECT child_id, Child_Name, Birth_Date 
            FROM child 
            WHERE motherUserId = :MotherId";

        $statement = self::prepare($sql);

        $statement->bindValue(":MotherId", $motherUserId);

        $statement->execute();

        $childrenDetails = $statement->fetchAll(PDO::FETCH_OBJ);

        return $childrenDetails;
    }

    public function getMotherChildrenHTML($MotherId)
    {
        $childrenDetails = $this->getMotherChildren($MotherId);

        $html = '<h2>Children</h2><br><div class="card-row">';

        foreach ($childrenDetails as $child) {
            $html .= '<div class="card">';
            $html .= '<h3>' . $child->Child_Name . '</h3><br>';
            $html .= '<b>DOB: </b>' . $child->Birth_Date . '<br><br>';
            $html .= '</div>';
        }

        // Close the card-row div
        $html .= '</div>';

        return $html;
    }



}
