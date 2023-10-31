<?php

/**
 * Class Register
 *
 * @author  Sineth Dhananjaya <dhananjayaaps@gmail.com>
 * @package app\models
 */

namespace app\models;

use app\core\Application;
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
    public string $nic = '';
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
            'nic' => [self::RULE_REQUIRED,[self::RULE_MIN,'min' => 10],[self::RULE_MAX,'max' => 12],[
                self::RULE_UNIQUE ,'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN,'min' => 8],[self::RULE_MAX,'max' => 24]],
            'confirm_password' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'password']]
        ];
    }

    public function attributes(): array
    {
        return ['firstname','lastname','email','password','nic', 'status', 'role_id'];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getUserData($id)
    {
        return (new User)->findOne(User::class, ['id' => $id]);
    }

    public function getUserRole($userId)
    {
        $user = $this->findOne(User::class, ['id' => $userId]);
        return $user->role;
    }

    public function getRole(): int
    {
        return $this->role_id;
    }

    public function getRoleName(): string
    {
        $roleNames = ['Volunteer','Admin','Doctor','Pre Mother','Post Mother','Midwife'];
        return $roleNames[$this->role_id-1];
    }

    public function changeRole($newRoleId): bool
    {
        $validRole = (new UserRoles)->findOne(UserRoles::class, ['user_id' => $this->getId(), 'role_id' => $newRoleId]);
        if($validRole){
            $this->role_id = $newRoleId;
            return($this->update());
        }
        return false;
    }

    public function getUserByNIC($nic)
    {
        return (new User)->findOne(User::class, ['nic' => $nic]);
    }

}