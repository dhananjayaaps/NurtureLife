<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\core\Model;

class Doctor extends DbModel
{
    public string $nic = '';
    public string $user_id = '';
    public string $MOH_id = '';
    public string $SLMC_no = '';
    public string $clinic_id = '';

    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'SLMC_no' => [self::RULE_REQUIRED],
        ];
    }

    public function tableName(): string
    {
        return 'doctors';
    }

    public function primaryKey(): string
    {
        return 'MOH_id';
    }

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);


        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        }
        else{
            $exitUser = (new Doctor())->getUser($ValidateUser->getId());
            if($exitUser){
                $this->addError('nic', 'That user is already a Doctor');
                return false;
            }
            $exitSLMC = (new Doctor())->findOne(self::class, ["SLMC_no" => $this->SLMC_no]);
            if($exitSLMC){
                $this->addError('SLMC_no', 'That ID is already using');
                return false;
            }
            $exitClinic = (new Clinic())->findOne(Clinic::class, ["id" => $this->clinic_id]);
            if(!$exitClinic){
                $this->addError('clinic_id', 'That Clinic no exists');
                return false;
            }
            $this->user_id = $ValidateUser->id;

            // add a user role

            $userRole = new UserRoles();
            $userRole->role_id = 3;
            $userRole->user_id = $ValidateUser->id;
            $userRole->save();

            return parent::save();
        }

    }

    public function attributes(): array
    {
        return ['user_id','SLMC_no','clinic_id'];
    }

    private function getUser($id)
    {
        return (new Doctor())->findOne(Doctor::class, ['user_id' => $id]);
    }

    public function getDoctors(): string
    {
        $doctorData = (new Doctor())->findAll(self::class);

        $data = [];

        foreach ($doctorData as $doctor) {
            $user = self::findOne(User::class, ["id" => $doctor->user_id]);
            $clinic = self::findOne(Clinic::class, ["id" => $doctor->clinic_id]);
            $data[] = [
                'MOH_ID' => $doctor->MOH_id,
                'Name' => $user->firstname . " " . $user->lastname,
                'SLMC_no' => $doctor->SLMC_no,
                'clinic_id' => $clinic->name
            ];
        }
        return json_encode($data);
    }

    public function getDoctorById($DoctorId): string
    {
        var_dump($DoctorId);
        $this->user_id = $DoctorId;
        $doctor = (new Doctor())->findOne(self::class, ['MOH_id' => $DoctorId]);
//        $user = self::findOne(User::class, ["id" => $doctor->user_id]);
//        $clinic = self::findOne(Clinic::class, ["id" => $doctor->clinic_id]);

        $data = [
            'clinic_id' => $doctor->clinic_id
        ];
        return json_encode($data);
    }

    public function getADoctor($MOH_id)
    {
        return (new Doctor())->findOne(self::class, ['MOH_id' => $MOH_id]);
    }

    public function update(): bool
    {
        if(!$this->clinic_id){
            $this->addError('Id', 'That Field is required');
            return false;
        }
        $exitClinic = (new Clinic())->findOne(Clinic::class, ["id" => $this->clinic_id]);
        if(!$exitClinic){
            $this->addError('Id', 'That Clinic no exists');
            return false;
        }
        return parent::update();
    }

    public function delete(): bool
    {
        self::deleteWhere(UserRoles::class, ['user_id' => $this->user_id, 'role_id' => 3]);
        return parent::delete();
    }

}
