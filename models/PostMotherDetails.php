<?php

namespace app\models;

use app\core\db\DbModel;

class PostMotherDetails extends DbModel
{
    public string $MotherId = '';
    public string $breast_problems = '';
    public string $abnormal_vaginal_discharge = '';
    public string $excessive_vaginal_bleeding = '';
    public string $pallor = '';
    public string $lcterus = '';
    public string $dema = '';
    public string $bp = '';
    public string $cardiovascular_system = '';
    public string $respiratory_system = '';
    public string $abdominal_examination = '';
    public string $mental_status = '';
    public string $family_planning_method = '';

    public function rules(): array
    {
        return [

        ];
    }

    public function tableName(): string
    {
        return 'Mothers';
    }

    public function primaryKey(): string
    {
        return 'MotherId';
    }

    public function attributes(): array
    {
        return [
            'breast_problems',
            'abnormal_vaginal_discharge',
            'excessive_vaginal_bleeding',
            'pallor',
            'lcterus',
            'dema',
            'bp',
            'cardiovascular_system',
            'respiratory_system',
            'abdominal_examination',
            'mental_status',
            'family_planning_method',


        ];
    }

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);

        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        } else {
            $exitUser = (new Mother())->getUser($ValidateUser->getId());


            $this->user_id = $ValidateUser->id;
            var_dump("errors", $this->errors);
            return parent::save();
        }
        return parent::save();

    }

}