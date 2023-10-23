<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;

namespace app\controllers\AdminController;

use app\models\AddDoctor;

class AdminController extends \app\core\Controller
{
    public function addDoctor(){
        $addDoctorModel = new AddDoctor();
        return $this->render('admin/addDoctor',[
            'model' => $addDoctorModel
        ]);
    }

    public function clinics(): array|false|string
    {
        $this->layout = 'admin';
        return $this->render('admin/clinics');
    }
}