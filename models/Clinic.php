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
use PDO;

class Clinic extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
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

    public function getClinicsList()
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
//        $clinicData = (new Clinic())->findAll(self::class);
        $data = [];

        $sql = "SELECT c.id AS clinic_id, c.name AS clinic_name, c.district, c.address, COUNT(DISTINCT m.user_id) AS mother_count, COUNT(DISTINCT mid.PHM_id) AS midwife_count, COUNT(DISTINCT doc.user_id) AS doctor_count FROM clinics c LEFT JOIN Mothers m ON c.id = m.clinic_id LEFT JOIN midwife mid ON c.id = mid.clinic_id LEFT JOIN doctors doc ON c.id = doc.clinic_id GROUP BY c.id, c.name, c.district, c.address";

        $statement = self::prepare($sql);

        $statement->execute();
        $clinicData = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($clinicData as $clinic) {
            $data[] = [
                'clinicID' => $clinic->clinic_id,
                'name' => $clinic->clinic_name,
                'totalMothers' => $clinic->mother_count,
                'totalMidwives' => $clinic->midwife_count,
                'totalDoctors' => $clinic->doctor_count,
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