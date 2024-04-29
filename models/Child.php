<?php

namespace app\models;

use app\core\db\DbModel as parentAlias;
Use app\models\User;
use PDO;

class Child extends parentAlias
{


    public int $child_id;

    public string $nic = '';
    public int $motherUserId;
    public string $Child_Name = '';
    public string $Birth_Date = '';
    public string $Birth_Place = '';
    public string $Gender = '1';


    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'Birth_Date' => [self::RULE_REQUIRED],
            'Birth_Place' => [self::RULE_REQUIRED],
            'Gender' => [self::RULE_REQUIRED],
            'Child_Name' => [self::RULE_REQUIRED],
        ];
    }

    public function tableName(): string
    {
        return 'child';
    }

    public function primaryKey(): string
    {
        return 'child_id';
    }

    public function attributes(): array
    {
        return [
            'motherUserId',
            'Child_Name',
            'Birth_Date',
            'Birth_Place',
            'Gender',
        ];
    }

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);
        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        } else {
            $this->motherUserId = $ValidateUser->id;
//            var_dump($this);
            return parent::save();
        }
    }


    public function getChilds(): string
    {
        $childData = (new Child())->findAll(self::class);
        $data = [];

        foreach ($childData as $child) {
            $data[] = [
                'ChildName' => $child->Child_Name,
                'Birth_Date' => $child->Mother_Name,
                'Birth_Place' => $child->Register_NO,
                'Gender' => $child->Gender,
            ];
        }
        return json_encode($data);
    }

    public function getDailyRegistrationCount()
    {
        $sql = "SELECT COUNT(*) as count FROM child WHERE Birth_Date = CURDATE()";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchObject();
        return $data->count;
    }

    public function getMotherCountForAdmin()
    {
        // Get the current month
        $currentMonth = date('n');

        $sql = "SELECT COUNT(*) AS Registration_Count, MONTH(Created_At) AS Registration_Month FROM child WHERE Created_At BETWEEN DATE_SUB(NOW(), INTERVAL 12 MONTH) AND NOW() GROUP BY MONTH(Created_At) ORDER BY MONTH(Created_At) ASC";
        $statement = self::prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $data = array_fill(0, 12, 0); // Initialize an array with zeros for each month
        $index = $currentMonth; // Start from the current month

        foreach ($result as $item) {
            $monthIndex = $index % 12; // Get the array index by using modulo to loop around
            $data[$monthIndex] = $item->Registration_Count;
            $index++;
        }
        return json_encode($data);
    }

    public function getChildCountForAdmin(): false|string
    {
        // Get the current month
        $currentMonth = date('n');

        $sql = "SELECT COUNT(*) AS Registration_Count, MONTH(Created_At) AS Registration_Month FROM child WHERE Created_At BETWEEN DATE_SUB(NOW(), INTERVAL 12 MONTH) AND NOW() GROUP BY MONTH(Created_At)";
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
}