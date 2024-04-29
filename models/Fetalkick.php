<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\models\Mother;
use PDO;
use app\core\Model;


class Fetalkick extends DbModel
{
    public string $RecordId ='';
    public string $MotherId;
    public string $KickCount ='';

    public function rules(): array
    {
        return[

            'KickCount'=> [self::RULE_REQUIRED]

        ];
    }

    public function tableName(): string
    {
       return 'fetalkick';
    }

    public function primaryKey(): string
    {
        return 'RecordId';
    }

    public function attributes(): array
    {
       return [
            'KickCount',
            'MotherId'
           ];
    }
    public function getKicks(): string
    {
        $MotherId = (new Mother())->getMotherId();
        $KickData = (new Fetalkick())->findAll(self::class,['MotherId'=>$MotherId]);
        $data = [];

        foreach ($KickData as $Kicks) {
            $data[] = [
                'Date' => $Kicks->Time,
                'Count' => $Kicks->KickCount
            ];
        }
        return json_encode($data);
    }
//    public function getMotherId()
//    {
//        $UserId = Application::$app->user->getId();
//        $MotherData = self::findOne(Mother::class, ['user_id' => $UserId]);
//        return $MotherData->MotherId;
//    }
    public function save(): bool
    {
        $this->MotherId = (new Mother())->getMotherId();
        return parent::save(); // TODO: Change the autogenerated stub
    }

    public function isNew(): bool
    {
        $Tdy_rec= Fetalkick::findOneByMotherIdAndDate(Fetalkick::class);
        return (empty($Tdy_rec));
    }
    static public function findOneByMotherIdAndDate($modelClass)
    {
        $tableName = (new $modelClass())->tableName();
        $currentDate = date("Y-m-d"); // Get the current date in the "YYYY-MM-DD" format
        $motherId = (new Mother())->getMotherId();

        $sql = "MotherId = :motherId AND DATE_FORMAT(Time, '%Y-%m-%d') = :currentDate";

//        $sql->bindValue(":motherId", $motherId);
//        $sql->bindValue(":currentDate", $currentDate);

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        $statement->bindValue(":motherId", $motherId);
       $statement->bindValue(":currentDate", $currentDate);

        $statement->execute();

        return $statement->fetchObject(static::class);
    }
}
