<?php

namespace app\controllers\AdminController;

use app\core\Application;
use app\core\Request;
use app\models\Clinic;
use app\models\Doctor;
use app\models\User;

class DoctorController extends \app\core\Controller
{
    public function Doctor(Request $request): array|false|string
    {
        $doctor = new Doctor();
        $doctor2 = new Doctor();

        if ($request->isPost()) {
            $this->setLayout('admin');
            $doctor->loadData($request->getBody());

            if ($doctor->validate() && $doctor->save()) {
                Application::$app->session->setFlash('success', 'New doctor created successfully');
                Application::$app->response->redirect('/doctors');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'admin';
        }

        return $this->render('admin/Doctor', [
            'model' => $doctor, "modelUpdate" => $doctor2
        ]);
    }

    public function DoctorsUpdate(Request $request): false|string
    {
        $clinicId = $request->getBody()['clinic_id'];
        $doctor = (new Doctor())->getADoctor($request->getBody()['MOH_id']);

        if ($doctor) {
            $doctor->loadData($request->getBody());
            $doctor->clinic_id = $clinicId;
            if ($doctor->update()) {
                header('Content-Type: application/json');
                http_response_code(200);
                return json_encode(['message' => 'Data updated successfully']);
            } else {
                header('Content-Type: application/json');
                http_response_code(400);
                return json_encode(['message' => 'Failed To Update', 'errors' => $doctor->getErrorMessages()]);
            }
        } else {
            // Handle the case where a doctor with the given clinic_id was not found.
            header('Content-Type: application/json');
            http_response_code(404);
            return json_encode(['message' => 'Doctor not found']);
        }
    }


    public function DoctorDelete(Request $request): false|string
    {

        $doctor = (new Doctor())->getADoctor($request->getBody()['MOH_id']);
        if ($doctor->delete()) {
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data successfully deleted']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Request Failed', 'errors' => $doctor->getErrorMessages()]);
        }
    }

    public function getDoctorDetails(Request $request): string
    {
        $doctor = new Doctor();
        $doctor->loadData($request->getBody());
        return $doctor->getDoctorById($doctor->getId());
    }

}