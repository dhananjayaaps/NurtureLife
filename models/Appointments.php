<?php

namespace app\models;

use app\core\db\DbModel;
use app\models\Mother;

class Appointments extends DbModel
{
    public int $AppointmentId = 0;
    public string $MotherId = '';
    public int $AppointType = 1;
    public string $AppointDate = '';
    public string $AppointStatus = '';
    public string $AppointRemarks = '';

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
            'AppointRemarks'
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
            'AppointRemarks' => [self::RULE_REQUIRED]
        ];
    }

    public function getAppointmentsByMotherId(): string
    {
        $MotherId = ( new Mother())->getMotherId();
        $appointments = ( new Appointments())->findAll(self::class, ['MotherId'=>$MotherId, 'AppointStatus'=> 1 ]);
        $data = [];

        foreach ($appointments as $appointData) {
            $data[] = [
                'Type' => $appointData->AppointType,
                'Date' => $appointData->AppointDate,
                'Remarks' => $appointData->AppointRemarks
            ];
        }
        return json_encode($data);
    }
}