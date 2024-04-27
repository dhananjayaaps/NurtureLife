<?php

namespace app\models;

use app\core\db\DbModel;

class Immunization extends DbModel
{
    public int $child_id = 0;

    public int $AppointType = 1;
    public string $AppointDate = '';
    public string $AppointStatus = '';
    public string $AppointRemarks = '';

    public function tableName(): string
    {
        return 'appointments';
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
}