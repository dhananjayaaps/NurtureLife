<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use mysql_xdevapi\Statement;
use PDO;

class Appointments extends DbModel
{
    public int $AppointmentId = 0;
    public string $MotherId = '';
    public int $AppointType = 1;
    public string $AppointDate = '';
    public string $AppointStatus = '';
    public string $AppointRemarks = '';
    public string $time = '';

    public function tableName(): string
    {
        return 'Appointments';
    }

    public function attributes(): array
    {
        return [
            'MotherId',
            'AppointType',
            'AppointDate',
            'AppointStatus',
            'AppointRemarks',
            'time'
        ];
    }

    public function primaryKey(): string
    {
        return 'AppointmentId';
    }

    public function rules(): array
    {
        return [
            'MotherId' => [self::RULE_REQUIRED],
            'AppointType' => [self::RULE_REQUIRED],
            'AppointDate' => [self::RULE_REQUIRED],
            'AppointStatus' => [self::RULE_REQUIRED],
            'time' => [self::RULE_REQUIRED],
        ];
    }

    public function getMothersForMidwife() {
        $sql = "SELECT Mothers.MotherId, users.firstname, users.city, users.lastname, Mothers.Status, Mothers.DeliveryDate, Mothers.PHM_ID FROM Mothers INNER JOIN users ON Mothers.user_id = users.id INNER JOIN midwife ON Mothers.PHM_ID = midwife.PHM_id WHERE midwife.user_id = 1";

        $stmt = self::prepare($sql);
        $stmt->execute();
        $motherData = $stmt->fetchAll(PDO::FETCH_OBJ);
        $statusNames = ['Inactive', 'Prenatal', 'Postnatal', 'Both', 'Special'];
        $data2 = [];


        foreach ($motherData as $mother) {
            $data2[] = [
                'MotherId' => $mother->MotherId,
                'Name' => $mother->firstname . " " . $mother->lastname,
                'Status' => $statusNames[(int)$mother->Status],
                'City' => $mother->city,
                'DeliveryDate' => $mother->DeliveryDate,
                'PHM_id' => $mother->PHM_ID,
            ];
        }
        return json_encode($data2);
    }
}