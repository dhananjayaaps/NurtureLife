<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr",$attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',',$attributes).") 
            VALUES (".implode(',',array_map(fn($attr) => ":$attr",$attributes)).")");
        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute",$this->{$attribute});
        }
        $statement->execute();
        return true;
   }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
