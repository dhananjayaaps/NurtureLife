<?php

/**
 * Class Register
 *
 * @author  Sineth Dhananjaya <dhananjayaaps@gmail.com>
 * @package app\models
 */

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_DOCTOR = 3;
    const ROLE_PRE_MOTHER = 4;
    const ROLE_POST_MOTHER = 5;
    const ROLE_MIDWIFE = 6;

    public string $firstname = '';
    public string $lastname ='';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public int $role_id;
    public string $confirm_password = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }
    public function save(): bool
    {
        $this->status = self::STATUS_ACTIVE;
        $this->role_id = self::ROLE_USER;
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE ,'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN,'min' => 8],[self::RULE_MAX,'max' => 24]],
            'confirm_password' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'password']]
        ];
    }

    public function attributes(): array
    {
        return ['firstname','lastname','email','password', 'status', 'role_id'];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getUserData($id)
    {
        return (new User)->findOne(['id' => $id]);
    }

    public function update() : bool
    {
        $this->status = self::STATUS_ACTIVE;
        return parent::update();
    }

    public function getUserRole($userId)
    {
        $user = $this->findOne(['id' => $userId]);
        return $user->role;
    }


}