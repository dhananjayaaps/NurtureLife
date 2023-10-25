<?php

namespace app\models;

use app\core\db\DbModel;

class UserRoles extends DbModel
{
    public int $user_id;
    public int $role_id;

    public function tableName(): string
    {
        return 'user_roles';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->user_id = (new User())->getId();
        return parent::save();
    }

    public function getRoles(): string
    {
        $roles = (new UserRoles())->findAll(self::class);
        $data = [];

        foreach ($roles as $role) {
            $data[] = $role->role_id;
        }
        return json_encode($data);
    }

    public function attributes(): array
    {
        return ['role_id'];
    }

    public function rules(): array
    {
        return [
            'role_id' => [self::RULE_REQUIRED]
        ];
    }
}