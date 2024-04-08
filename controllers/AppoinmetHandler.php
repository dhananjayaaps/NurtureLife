<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\models\Mother;

class AppoinmetHandler extends Controller
{
    public function appointments(): array|false|string
    {
        $model = new Mother();
        $roleName = Application::$app->user->getRoleName();
        if ($roleName == 'Doctor'){
            $this->layout = 'doctor';
            return $this->render('doctor/appointments', ['model' => $model]);
        }

        else if ($roleName == 'Midwife'){
            $this->layout = 'midwife';
            return $this->render('midwife/appointments');
        }
        else{
            return $this->render('/', [
                'model' => $model
            ]);
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