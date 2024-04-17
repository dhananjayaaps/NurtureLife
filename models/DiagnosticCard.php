<?php

namespace app\models;

class DiagnosticCard
{
    public int $DiagnosticCardId = 0;
    public string $PatientId = '';
    public int $PatientType = 1;
    public string $DoctorId = '';
    public string $Date = '';
    public string $Diagnosis = '';
    public string $Prescription = '';
    public string $Remarks = '';

}


//    public int $AppointmentId = 0;
//    public string $MotherId = '';
//    public int $AppointType = 1;
//    public string $AppointDate = '';
//    public string $AppointStatus = '';
//    public string $AppointRemarks = '';
//
//    public function tableName(): string
//    {
//        return 'appointments';
//    }
//
//    public function attributes(): array
//    {
//        return [
//            'MotherId',
//            'AppointType',
//            'AppointDate',
//            'AppointStatus',
//            'AppointRemarks'
//        ];
//    }
//
//    public function primaryKey(): string
//    {
//        return 'AppointmentId';
//    }
//
//    public function rules(): array
//    {
//        return [
//            'MotherId' => [self::RULE_REQUIRED],
//            'AppointType' => [self::RULE_REQUIRED],
//            'AppointDate' => [self::RULE_REQUIRED],
//            'AppointStatus' => [self::RULE_REQUIRED],
//            'AppointRemarks' => [self::RULE_REQUIRED]
//        ];
//    }
//}