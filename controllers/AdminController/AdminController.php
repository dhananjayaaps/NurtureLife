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
        $clinic2 = new Clinic();
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
        else if ($request->isPut()){
            $this->setLayout('admin');
            $clinic->loadData($request->getBody());
            if ($clinic->validate() && $clinic->update()) {
                Application::$app->session->setFlash('success', 'Updated Clinic Successfully');
                Application::$app->response->redirect('/clinics');
                exit;
            }
        }
        return $this->render('admin/clinics', [
            'model' => $clinic, "modelUpdate" => $clinic2
        ]);
    }

    public function clinicsUpdate(Request $request)
    {
        $clinic = new Clinic();
        $this->setLayout('admin');
        $clinic->loadData($request->getBody());
        $clinic->validate();
        if ($clinic->validate()) {
            // Data is valid, you can perform further actions here

            // Send a success response
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => 'Data updated successfully']);
        } else {

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => 'Validation failed', 'errors' => $clinic->errorMessages()]);
        }

    }

    public function getClinicDetails(Request $request): string
    {
        $clinic = new Clinic();
        $clinic->loadData($request->getBody());
        return $clinic->getClinicById($clinic->getId());
    }

    public function reports(): array|false|string
    {
        $this->layout = 'admin';
        return $this->render('admin/reports');
    }
}