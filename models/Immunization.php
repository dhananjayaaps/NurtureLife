<?php

namespace app\models;

use app\core\db\DbModel;
use PDO;

class Immunization extends DbModel
{
    public string $recordId;
    public int $child_id;
    public string $vac_id = '';
    public string $BatchNo = '';
    public string $timestamp = '';

    public function tableName(): string
    {
        return 'Immunization';
    }

    public function attributes(): array
    {
        return [
            'child_id',
            'vac_id',
            'BatchNo',
        ];
    }

    public function primaryKey(): string
    {
        return 'recordId';
    }

    public function rules(): array
    {
        return [
            'child_id' => [self::RULE_REQUIRED],
            'BatchNo' => [self::RULE_REQUIRED],
        ];
    }

    public function getImmunization($child_id)
    {
        $sql = "SELECT * FROM Immunization WHERE child_id = :child_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':child_id', $child_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
