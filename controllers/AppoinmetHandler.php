<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\models\Appointments;
use app\models\Midwife;
use app\models\Mother;
use app\models\User;

class AppoinmetHandler extends Controller
{
    public function appointments()
    {
        $model = new Mother();
        $appointmentModel = new Appointments();
        $roleName = Application::$app->user->getRoleName();
        if ($roleName == 'Doctor'){
            $this->layout = 'doctor';
            return $this->render('doctor/appointments', ['model' => $model]);
        }

        else if ($roleName == 'Midwife'){
            $this->layout = 'midwife';
            return $this->render('midwife/appointments', [
                'model' => $model,
                'appointmentModel' => $appointmentModel
            ]);
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