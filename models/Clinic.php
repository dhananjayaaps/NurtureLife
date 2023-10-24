<?php

/**
 * Class Clinic
 *
 * @author  Sineth Dhananjaya <dhananjayaaps@gmail.com>
 * @package app\models
 */

namespace app\models;

use app\core\db\DbModel;

class Clinic extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $name = '';
    public string $district ='';
    public string $address = '';
    public int $gn_units = 0;

    public int $status = self::STATUS_INACTIVE;

    public function tableName(): string
    {
        return 'clinics';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_ACTIVE;
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED,[
                self::RULE_UNIQUE ,'class' => self::class
            ]],
            'district' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED ],
            'gn_units' => [self::RULE_REQUIRED]

        ];
    }

    public function attributes(): array
    {
        return ['name','district','address','gn_units'];
    }

    public function update() : bool
    {
        $this->status = self::STATUS_ACTIVE;
        return parent::update();
    }

}