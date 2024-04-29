<?php

namespace app\models;

use app\core\db\DbModel as parentAlias;

class Child extends parentAlias
{


    public int $child_id = 0;

    public int $nic = 0;
    public string $Child_Name = '';
    public string $Register_NO = '';
    public string $Birth_Date = '';
    public string $Birth_Place = '';
    public string $Mother_Name = '';
    public string $Address = '';
    public string $Gender = '';


    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'Birth_Date' => [self::RULE_REQUIRED],
            'Register_NO' => [self::RULE_REQUIRED],
            'Birth_Place' => [self::RULE_REQUIRED],
            'Mother_Name' => [self::RULE_REQUIRED],
            'Gender' => [self::RULE_REQUIRED],
            'Child_Name' => [self::RULE_REQUIRED],
        ];
    }

    public function tableName(): string
    {
        return 'child';
    }

    public function primaryKey(): string
    {
        return 'child_id';
    }

    public function attributes(): array
    {
        return [
            'nic',
            'Child_Name',
            'Register_NO',
            'Birth_Date',
            'Birth_Place',
            'Mother_Name',
            'Gender',


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


    public function getChilds(): string
    {
        $childData = (new Child())->findAll(self::class);
        $data = [];

        foreach ($childData as $child) {
            $data[] = [
                'ChildName' => $child->Child_Name,
                'MotherName' => $child->Mother_Name,
                'RegistrationNo' => $child->Register_NO,
                'Gender' => $child->Gender,

            ];
        }

        return json_encode($data);
    }

    public function getDailyRegistrationCount()
    {
        $sql = "SELECT COUNT(*) as count FROM child WHERE Birth_Date = CURDATE()";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchObject();
        return $data->count;
    }

}