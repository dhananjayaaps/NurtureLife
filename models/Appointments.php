<?php

namespace app\models;

use app\core\db\DbModel;

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
}