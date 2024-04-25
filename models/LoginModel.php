<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use app\core\Request;
use app\core\Response;

class LoginModel extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login()
    {
        $user = (new User)->findOne(User::class, ['email' => $this->email]);

        if (!$user) {
            $this->addError('email', 'User does not exist with this Email Address');
            return -1;
        }
        if ($user->status == User::STATUS_INACTIVE) {
            return User::STATUS_INACTIVE;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return -1;
        }

        if ($user->status == User::STATUS_Email_NOT_VERIFIED) {
            return User::STATUS_Email_NOT_VERIFIED;
        }

        Application::$app->login($user);
        return User::STATUS_ACTIVE;
    }
}