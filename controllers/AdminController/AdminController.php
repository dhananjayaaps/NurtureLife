<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;

namespace app\controllers\AdminController;

use app\core\Application;
use app\core\Request;
use app\models\AddDoctor;
use app\models\Clinic;
use app\models\UserRoles;

class AdminController extends \app\core\Controller
{
    public function addDoctor(){
        $addDoctorModel = new AddDoctor();
        return $this->render('admin/addDoctor',[
            'model' => $addDoctorModel
        ]);
    }

    public function clinics(Request $request): array|false|string
    {
        $clinic = new Clinic();
        if ($request->isPost()) {

            $this->setLayout('admin');
            $clinic->loadData($request->getBody());

            if ($clinic->validate() && $clinic->save()) {
                Application::$app->session->setFlash('success', 'Added a new Clinic');
                Application::$app->response->redirect('/clinics');
                exit;
            }
        }
        else if ($request->isGet()) {
            $this->layout = 'admin';
        }
        return $this->render('admin/clinics', [
            'model' => $clinic
        ]);
    }


    public function reports(): array|false|string
    {
        $this->layout = 'admin';
        return $this->render('admin/reports');
    }
}