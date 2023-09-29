<?php

namespace app\models;

use app\core\Model;

class LoginModel extends Model
{
    public string $nic = '';
    public string $password = '';

    public function login()
    {
        echo 'Login user';
    }

    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }
}