<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class MotherController extends Controller
{
    public function MotherProfile()
    {
            $this->layout = 'midwife';
            return $this->render('preMother/profile');
//        $roleName = Application::$app->user->getRoleName();
//        if ($roleName == 'Doctor'){
//            $this->layout = 'doctor';
//            return $this->render('doctor/appointments');
//        }
//
//        else if ($roleName == 'Midwife'){
//            $this->layout = 'midwife';
//            return $this->render('midwife/appointments');
//        }
//        else{
//            return $this->render('/');
//        }
    }
}