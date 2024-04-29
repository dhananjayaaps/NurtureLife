<?php

namespace app\models;

use app\core\db\DbModel as parentAlias;

class BabyHealthChart extends parentAlias
{
    public int $child_id;
    public string $skin_color= '';
    public string $eyes= '';
    public string $pecan= '';
    public string $breast_feeding= '1';
    public string $breastfeeding_position= '1';
    public string $breastfeeding_relationship= '1';
    public string $other= '';
    public string $time_duration= '1';

    public function rules(): array
    {
        return [
            'time_duration' => [self::RULE_REQUIRED],
            'skin_color' => [self::RULE_REQUIRED],
            'eyes' => [self::RULE_REQUIRED],
            'pecan' => [self::RULE_REQUIRED],
            'breast_feeding' => [self::RULE_REQUIRED],
            'breastfeeding_position' => [self::RULE_REQUIRED],
            'breastfeeding_relationship' => [self::RULE_REQUIRED],
        ];
    }

    public function tableName(): string
    {
        return 'BabyHealthChart';
    }

    public function primaryKey(): string
    {
        return 'child_id';
    }

    public function attributes(): array
    {
        return [
            'skin_color',
            'eyes',
            'pecan',
            'breast_feeding',
            'breastfeeding_position',
            'breastfeeding_relationship',
            'other',
            'time_duration',
        ];
    }

//    public function save(): bool
//    {
//        $ValidateUser = (new User())->getUserByNIC($this->nic);
//
//        if (!$ValidateUser) {
//            $this->addError('nic', 'User does not exist with this NIC');
//            return false;
//        }
//        else{
//            $exitUser = (new Mother())->getUser($ValidateUser->getId());
//
//
//            $this->user_id = $ValidateUser->id;
//            var_dump("errors", $this->errors);
//            return parent::save();
//        }
//        return parent::save();
//
//    }
}
