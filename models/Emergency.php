<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Emergency extends DbModel
{
    public string $id = '';
    public string $user_id = '';
    public string $name ='';
    public string $role_id = '';
    public string $pressed_at = '';

    public function tableName(): string
    {
        return 'emergency';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->user_id = Application::$app->user->getId();
        $this->name = Application::$app->user->getDisplayName();
        $this->role_id = Application::$app->user->getRole();
        $this->pressed_at = date('Y-m-d H:i:s');
        return parent::save();
    }

    public function getEmergencyList(): array
    {
        $emergencies = (new Emergency())->findAll(Emergency::class);
        $data = [];
        foreach ($emergencies as $emergency) {
            $data[] = [
                'id' => $emergency->id,
                'user_id' => $emergency->user_id,
                'name' => $emergency->name,
                'role_id' => $emergency->role_id,
                'pressed_at' => $emergency->pressed_at
            ];
        }
        return ($data);
    }

    public function attributes(): array
    {
        return ['user_id', 'name', 'role_id', 'pressed_at'];
    }

    public function getEmergencies(): false|string
    {
        $emergencyData = [];
        if(Application::$app->user->getRoleName() == 'Midwife'){
            $emergencyData = (new Emergency())->findAll(self::class);
            return json_encode($emergencyData);
        }
        return json_encode($emergencyData);
    }
    public function rules(): array
    {
        return [
            'user_id' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED],
            'role_id' => [self::RULE_REQUIRED],
            'pressed_at' => [self::RULE_REQUIRED]
        ];
    }
}