<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;

class AppoinmetHandler extends Controller
{
    public function appointments()
    {
        $roleName = Application::$app->user->getRoleName();
        if ($roleName == 'Doctor'){
            $this->layout = 'doctor';
            return $this->render('doctor/appointments');
        }

        else if ($roleName == 'Midwife'){
            $this->layout = 'midwife';
            return $this->render('midwife/appointments');
        }
        else{
            return $this->render('/');
        }
    }

//    public function mothers(){
//
//        if ($roleName == 'Doctor'){
//            $this->layout = 'doctor';
//            return $this->render('doctor/appointments');
//        }
//    }

}