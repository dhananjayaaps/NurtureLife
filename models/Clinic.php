<?php

/**
 * Class Clinic
 *
 * @author  Sineth Dhananjaya <dhananjayaaps@gmail.com>
 * @package app\models
 */

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Clinic extends DbModel
{
    const int STATUS_INACTIVE = 0;
    const int STATUS_ACTIVE = 1;
    const int STATUS_DELETED = 2;
    public string $id = '';

    public string $name = '';
    public string $district ='';
    public string $address = '';
    public string $created_at = '';

    public int $status = self::STATUS_INACTIVE;

    public function tableName(): string
    {
        return 'clinics';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_ACTIVE;
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED,[
                self::RULE_UNIQUE ,'class' => self::class
            ]],
            'district' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED ],
        ];
    }

    public function getClinicsList(): array
    {
        $clinics = (new Clinic())->findAll(Clinic::class);
        $data = [];
        foreach ($clinics as $clinic) {
            $data[] = [
                'id' => $clinic->id,
                'name' => $clinic->name
            ];
        }
        return ($data);
    }

    public function getClinics(): string
    {
        $clinicData = (new Clinic())->findAll(self::class);
        $data = [];

        foreach ($clinicData as $clinic) {
            $data[] = [
                'clinicID' => $clinic->id,
                'name' => $clinic->name,
                'totalMothers' => 150,
                'totalMidwives' => 23
            ];
        }
        return json_encode($data);
    }

    public function getClinicById($ClinicId): string
    {
        $this->id = $ClinicId;
        $clinicData = (new Clinic())->findOne(self::class, ['id' => $ClinicId]);

        $data = [
            'clinicID' => $clinicData->id,
            'name' => $clinicData->name,
            'district' => $clinicData->district,
            'address' => $clinicData->address
        ];
        return json_encode($data);
    }

    public function getAClinic($id)
    {
        return (new Clinic())->findOne(self::class, ['id' => $id]);
    }

    public function attributes(): array
    {
        return ['name','district','address'];
    }

    public function update() : bool
    {
        $this->status = self::STATUS_ACTIVE;
        return parent::update();
    }

}