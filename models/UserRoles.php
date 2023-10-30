<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class UserRoles extends DbModel
{
    public int $user_id;
    public int $role_id;

    /**
     * @param int $role_id
     */
    public function __construct(int $role_id = 1)
    {
        $this->role_id = $role_id;
    }


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
        $this->user_id = self::findOne(User::class, ['email' => $this->email])->id ?? 0;
        return parent::save();
    }

    public function saveByEmail($email): bool
    {
        $this->user_id = self::findOne(User::class, ['email' => $email])->id ?? 0;
        return parent::save();
    }

    public function getRoles(): string
    {
        $roles = Application::$app->userRoles->findAll(self::class);
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