<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\core\Model;
use PDO;

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
        $joins = [
            ['model' => User::class, 'condition' => 'doctors.user_id = users.id'],
            ['model' => Clinic::class, 'condition' => 'doctors.clinic_id = clinics.id']
        ];
        $doctorData = (new Doctor())->findAllWithJoins(self::class, $joins, []);

        $data = [];

        foreach ($doctorData as $doctor) {
            $data[] = [
                'MOH_ID' => $doctor->MOH_id,
                'Name' => $doctor->firstname . " " . $doctor->lastname,
                'SLMC_no' => $doctor->SLMC_no,
                'clinic_id' => $doctor->name
            ];
        }
        return json_encode($data);
    }

    public function getDoctorById($DoctorId): string
    {
        var_dump($DoctorId);
        $this->user_id = $DoctorId;
        $doctor = (new Doctor())->findOne(self::class, ['MOH_id' => $DoctorId]);

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
    public function getDocId()
    {
        $UserId = Application::$app->user->getId();
        $DoctorData = self::findOne(Doctor::class, ['user_id' => $UserId]);
        return $DoctorData->MOH_id;
    }
    public function getDocClinic()
    {
        $UserId = Application::$app->user->getId();
        $DoctorData = self::findOne(Doctor::class, ['user_id' => $UserId]);
        return $DoctorData->clinic_id;
    }
    public function getClinicDoctors()
    {
        $clinic = (new Doctor())->getDocClinic();

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
    public function getClinicMothers()
    {
        $clinic = (new Doctor())->getDocClinic();

        $sql = self::prepare("SELECT M.MotherId , U.firstname, U.lastname
                     From Mothers AS M, users AS U
                     WHERE M.user_id = U.id AND M.clinic_id = :clinicId");

        $sql->bindValue(":clinicId", $clinic);
        $sql->execute();

        // Fetch all rows as associative arrays
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Return the result as JSON
        return json_encode($result);
    }
    public function getClinicMidwiwes()
    {
        $clinic = (new Doctor())->getDocClinic();

        $sql = self::prepare("SELECT M.PHM_id , U.firstname, U.lastname
                     From midwife AS M, users AS U
                     WHERE M.user_id = U.id AND M.clinic_id = :clinicId");

        $sql->bindValue(":clinicId", $clinic);
        $sql->execute();

        // Fetch all rows as associative arrays
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Return the result as JSON
        return json_encode($result);
    }

}
