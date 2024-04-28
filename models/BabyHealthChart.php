<?php

namespace app\models;

use app\core\db\DbModel as parentAlias;

class BabyHealthChart extends parentAlias
{
    public int $child_id = 0;
    public string $skin_color= '';
    public string $eyes= '';
    public string $pecan= '';
    public string $breast_feeding= '';
    public string $breastfeeding_position= '';
    public string $breastfeeding_relationship= '';
    public string $other= '';
    public string $time_duration= '';




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

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);

        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        }
        else{
            $exitUser = (new Mother())->getUser($ValidateUser->getId());


            $this->user_id = $ValidateUser->id;
            var_dump("errors", $this->errors);
            return parent::save();
        }
        return parent::save();

    }


    public function getChilds(): string
    {
        $childData = (new Child())->findAll(self::class);
        $data = [];

        foreach ($childData as $child) {
//            $Child = self::findOne(Child::class, ["user_id" => $Child->user_id]);
//            $Child = self::findOne(Child::class, ["id" => $Child->Register_NO]);
            $data[] = [
                'ChildName' => $child->Child_Name,
                'MotherName' => $child->Mother_Name,
                'RegistrationNo' => $child->Register_NO,
                'Gender' => $child-> Gender,

            ];
        }

        return json_encode($data);
    }

//
//    public function getMothers(): string
//    {
//        // Implement a method to get a list of mothers similar to the getMidwifes method
//        // Fetch data from the database and format it as needed
//        // Return data in JSON format as shown in the getMidwifes method.
//    }
//
//    public function getMotherById($MotherId): string
//    {
//        // Implement a method to get mother details by ID
//        // Fetch data from the database based on MotherId and return it in JSON format.
//    }
//
//    public function getAMother($MotherId)
//    {
//        // Implement a method to get a single mother by ID similar to getAMidwife
//        // Fetch data from the database and return it, or return null if not found.
//    }
//
//    public function update(): bool
//    {
//        // Implement the update logic similar to the Midwife class
//        // Add validation, checks, and database updating logic
//        // Ensure you return true if the update is successful, and false if it fails.
//    }

    // Add any additional methods you need for the Mother module here
}
