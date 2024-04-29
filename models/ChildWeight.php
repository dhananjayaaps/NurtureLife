<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use PDO;
use app\core\Model;


class ChildWeight extends DbModel
{
    public string $weight_record_id ='';
    public string $child_id = '';
    public string $value_of_weight ='';

//    public string $Time = '';
    public function rules(): array
    {
        return[

            'value_of_weight'=> [self::RULE_REQUIRED],
            'child_id'=> [self::RULE_REQUIRED]

        ];
    }

    public function tableName(): string
    {
        return 'ChildWeight';
    }

    public function primaryKey(): string
    {
        return 'weight_record_id';
    }

    public function attributes(): array
    {
        return [
            'value_of_weight',
            'child_id',
//            'Time'
        ];
    }
    public function getWeight(): string
    {
        $child_id = $this->getChildId();
        $WeightData = (new ChildWeight())->findAll(self::class,['child_id'=>$child_id]);
        $data = [];

        foreach ($WeightData as $Weight) {
            $data[] = [
                'Date' => $Weight->Time,
                'Weight' => $Weight->value_of_weight
            ];
        }
        return json_encode($data);
    }

    public function getChildId(): string
    {
        return "1";
    }

    public function save(): bool
    {
        $this->child_id = $this->getChildId();
        return parent::save();
    }

    public function isNew(): bool
    {
        $Tdy_rec= ChildWeight::findOneByChildIdAndDate(ChildWeight::class);
        return (empty($Tdy_rec));
    }
    static public function findOneByChildIdAndDate($modelClass)
    {
        $tableName = (new $modelClass())->tableName();
        $currentDate = date("Y-m-d"); // Get the current date in the "YYYY-MM-DD" format
//        $childId = (new ChildWeight())->getChildId();
        $childId = 1;

        $statement = self::prepare("SELECT * FROM $tableName WHERE child_id = :childId AND DATE_FORMAT(Time, '%Y-%m-%d') = :currentDate");

        $statement->bindValue(":childId", $childId);
        $statement->bindValue(":currentDate", $currentDate);

        $statement->execute();
        return $statement->fetchObject(static::class);
    }

}
