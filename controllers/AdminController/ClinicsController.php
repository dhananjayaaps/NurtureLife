<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
namespace app\controllers\AdminController;
use app\core\Application;
use app\core\Request;
use app\models\Doctor;
use app\models\Clinic;
use app\models\UserRoles;

class ClinicsController extends \app\core\Controller
{
    public function clinics(Request $request): array|false|string
    {
        $clinic = new Clinic();
        $clinic2 = new Clinic();
        if ($request->isPost()) {
            $this->setLayout('admin');
            $clinic->loadData($request->getBody());
            if ($clinic->validate() && $clinic->save()) {
                Application::$app->session->setFlash('success', 'New Clinic created successfully');
                Application::$app->response->redirect('/clinics');
                exit;
            }
        }
        else if ($request->isGet()) {
            $this->layout = 'admin';
        }

        return $this->render('admin/clinics', [
            'model' => $clinic, "modelUpdate" => $clinic2
        ]);
    }

    public function clinicsUpdate(Request $request): false|string
    {
        $clinic = (new Clinic())->getAClinic($request->getBody()['id']);
        $this->setLayout('admin');
        $clinic->loadData($request->getBody());
        if ($clinic->validate()) {
            $clinic->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $clinic->getErrorMessages()]);
        }
    }

    public function clinicDelete(Request $request): false|string
    {
        $clinic = new Clinic();
        $clinic->id = $request->getBody()['id'];
        if ($clinic->delete()) {
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data successfully deleted']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Request Failed', 'errors' => $clinic->getErrorMessages()]);
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