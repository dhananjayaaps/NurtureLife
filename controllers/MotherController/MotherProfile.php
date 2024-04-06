<?php

namespace app\controllers\MotherController;

use app\core\Application;
use app\core\Controller;

class MotherProfile extends Controller
{
    public function motherProfile(): array|false|string
    {
        $roleName = Application::$app->user->getRoleName();

        if ($roleName == 'Doctor') {
            $this->layout = 'doctor';
        } else if ($roleName == 'Midwife') {
            $this->layout = 'midwife';
        } else {
            $this->setLayout('mother');
        }

        return $this->render('preMother/motherProfile');
    }
}