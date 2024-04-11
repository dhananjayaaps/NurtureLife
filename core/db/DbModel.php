<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;
use PDO;

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
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
        VALUES (".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
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

    static public function deleteWhere($modelClass, $where): void
    {
        $tableName = (new $modelClass())->tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("DELETE FROM $tableName WHERE $sql");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        // You might want to handle errors, check affected rows, etc.
    }


    static public function findOne($modelClass, $where)
   {
       $tableName = (new $modelClass())->tableName();
       $attributes = array_keys($where);
       $sql = implode(" AND ",array_map(fn($attr) => "$attr = :$attr",$attributes));
       $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

       foreach ($where as $key => $item){
           $statement->bindValue(":$key",$item);
       }
       $statement->execute();
       return $statement->fetchObject(static::class);
   }

    static public function findAll($modelClass, $where = []): false|array
    {
        $tableName = (new $modelClass())->tableName();

        $whereClause = '';

        if (!empty($where)) {
            $attributes = array_keys($where);
            $whereClause = "WHERE " . implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        }

        $sql = "SELECT * FROM $tableName $whereClause";

        $statement = self::prepare($sql);

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    static public function findAllWithJoins($mainModelClass, $joins ,$where = [], $aliases = []): false|array
    {
        $mainTableName = (new $mainModelClass())->tableName();

        $joinClauses = '';
        foreach ($joins as $join) {
            $joinModelClass = $join['model'];
            $joinTableName = (new $joinModelClass())->tableName();
            $joinCondition = $join['condition'];
            $joinClauses .= "JOIN $joinTableName ON $joinCondition ";
        }

        $whereClause = '';
        if (!empty($where)) {
            $attributes = array_keys($where);
            $whereClause = "WHERE " . implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        }

        $selectAliases = [];
        foreach ($aliases as $alias => $columnName) {
            $selectAliases[] = "$columnName AS $alias";
        }

        $selectClause = implode(", ", $selectAliases);

        $sql = "SELECT * $selectClause FROM $mainTableName $joinClauses $whereClause";

        $statement = self::prepare($sql);

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    static public function SQLRunner($query): false|array
    {
        $query->execute();
        $statement = self::prepare($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function prepare($sql): false|\PDOStatement
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public function getId()
    {
        return $this->{$this->primaryKey()};
    }

    public function getErrorMessages(): array
    {
        return $this->errors;
    }
}
