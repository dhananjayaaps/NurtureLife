<?php

namespace app\controllers\MotherController;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class MotherProfile extends Controller
{
    public function motherProfile(Request $request, Response $response): array|false|string
    {
        $roleName = Application::$app->user->getRoleName();
        $motherId =  $request->getBody()['id'];

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