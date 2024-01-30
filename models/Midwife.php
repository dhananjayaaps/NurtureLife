<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\core\Model;

class Midwife extends DbModel
{
    public string $nic = '';
    public string $user_id = '';
    public string $PHM_id = '';
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
        return 'midwife';
    }

    public function primaryKey(): string
    {
        return 'PHM_id';
    }

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);


        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        }
        else{
            $exitUser = (new Midwife())->getUser($ValidateUser->getId());
            if($exitUser){
                $this->addError('nic', 'That user is already a Midwife');
                return false;
            }
            $exitSLMC = (new Midwife())->findOne(self::class, ["SLMC_no" => $this->SLMC_no]);
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

            // save user role
            $userRole = new UserRoles();
            $userRole->user_id = $ValidateUser->id;
            $userRole->role_id = 6;
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
        return (new Midwife())->findOne(Midwife::class, ['user_id' => $id]);
    }

    public function getMidwifes(): string
    {
        $joins = [
            ['model' => User::class, 'condition' => 'midwife.user_id = users.id'],
            ['model' => Clinic::class, 'condition' => 'midwife.clinic_id = clinics.id']
        ];
        $phmData = (new Midwife())->findAllWithJoins(self::class, $joins, []);

        $data = [];

        foreach ($phmData as $phm) {
            $data[] = [
                'PHM_ID' => $phm->PHM_id,
                'Name' => $phm->firstname . " " . $phm->lastname,
                'SLMC_no' => $phm->SLMC_no,
                'clinic_id' => $phm->name
            ];
        }
        return json_encode($data);
    }

    public function getMidwifeById($MidwifeId): string
    {
        $this->user_id = $MidwifeId;
        $Midwife = (new Midwife())->findOne(self::class, ['PHM_id' => $MidwifeId]);
//        $user = self::findOne(User::class, ["id" => $Midwife->user_id]);
//        $clinic = self::findOne(Clinic::class, ["id" => $Midwife->clinic_id]);

        $data = [
            'clinic_id' => $Midwife->clinic_id
        ];
        return json_encode($data);
    }

    public function getAMidwife($PHM_id)
    {
        return (new Midwife())->findOne(self::class, ['PHM_id' => $PHM_id]);
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
        self::deleteWhere(UserRoles::class, ['user_id' => $this->user_id, 'role_id' => 6]);
        return parent::delete();
    }

}
