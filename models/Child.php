<?php

namespace app\models;

use app\core\db\DbModel as parentAlias;

class Child extends parentAlias
{

    public string $user_id = '';
    public string $child_id = '';

    public string $nic = '';
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
            'child_id' => [self::RULE_REQUIRED],
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
        return 'nic';
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'nic',
            'Child_Name',
            'Register_NO',
            'Birth_Date',
            'Birth_Place',
            'Mother_Name',
            'Gender',
            'no_of_apga',
            'birth_weight',
            'head_circumference_at_birth',
            'baby_length_at_birth',
            'health_condition',
            'vitamin_k',
            'premature_births',
            'low_birth_weight',
            'neonatal_complications',
            'congenital_disorders',
            'acute_conditions',
            'complementary_feeding',
            'growth_retardation',
            'difficulty_feeding',
            'death_of_mother_or_father',
            'migration_of_mother_or_father',
            'other_reasons',
            'skin_color',
            'eyes',
            'pecan',
            'breast_feeding',
            'breastfeeding_position',
            'breastfeeding_relationship',
            'other',
            'completion_date',
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
