<?php

namespace app\models;

use app\core\db\DbModel;

class PreMotherPersonalDetails extends DbModel
{

    public string $user_id = '';

    public string $nic = '';
    public string $MotherId = '';

    public string $age = '';
    public string $education_level = '';
    public string $occuption = '';
    public string $age1 = '';
    public string $education_level1 = '';
    public string $occuption1 = '';
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

            'age',
            'education_level',
            'occuption',
            'age1',
            'education_level1',
            'occuption1',



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