<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;
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

   public function update(): bool
   {
         $tableName = $this->tableName();
         $attributes = $this->attributes();
         $params = array_map(fn($attr) => "$attr = :$attr",$attributes);
         $statement = self::prepare("UPDATE $tableName SET ".implode(',',$params)." WHERE ".$this->primaryKey()." = :id");
         foreach ($attributes as $attribute){
              $statement->bindValue(":$attribute",$this->{$attribute});
         }
         $statement->bindValue(":id",$this->getId());
         $statement->execute();
         return true;
   }

    public function delete(): bool
    {
            $tableName = $this->tableName();
            $statement = self::prepare("DELETE FROM $tableName WHERE ".$this->primaryKey()." = :id");
            $statement->bindValue(":id",$this->getId());
            $statement->execute();
            return true;
    }

   static public function findOne($where)
   {
       $tableName = (new \app\models\User)->tableName();
       $attributes = array_keys($where);
       $sql = implode("AND ",array_map(fn($attr) => "$attr = :$attr",$attributes));
       $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

       foreach ($where as $key => $item){
           $statement->bindValue(":$key",$item);
       }

       $statement->execute();
       return $statement->fetchObject(static::class);
   }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public function getId()
    {
        return $this->{$this->primaryKey()};
    }

    public function getRole(): int
    {
        return $this->role_id;
    }

}