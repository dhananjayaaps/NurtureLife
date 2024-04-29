<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Clinic;
use app\models\Fetalkick;
use app\models\motherSymptoms;

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

    public function MotherSymptom(Request $request): array|false|string
    {
        $symptom1 = new motherSymptoms();
        $symptom2 = new motherSymptoms();
        if ($request->isPost()) {

            $this->setLayout('mother');
            $symptom1->loadData($request->getBody());

            if ($symptom1->validate() && $symptom1->save()) {
                Application::$app->session->setFlash('success', 'Symptoms Recorded successfully');
                Application::$app->response->redirect('/MotherSymptoms');
                exit;
            }
        } else if ($request->isGet()) {
            $this->layout = 'mother';

        }
//        var_dump(Application::$app->user->getId());

        return $this->render('preMother/motherSymptom', [
            'model' => $symptom1, "modelUpdate" => $symptom2
        ]);
    }

    public function MotherSymptomUpdate(Request $request): false|string
    {
        $symptomRec = (new motherSymptoms())->getARec($request->getBody()['symptomRecNo']);

//        $this->setLayout('mother');
        var_dump($request->getBody());
        $symptomRec->loadData($request->getBody());
        $symptomRec->validate();
        if ($symptomRec->validate()) {
            $symptomRec->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $symptomRec->getErrorMessages()]);
        }
    }

    public function MotherSymptomDelete(Request $request): false|string
    {
        $symptomRec = (new motherSymptoms());
        $symptomRec->symptomRecNo = $request->getBody()['symptomRecNo'];
        if ($symptomRec->delete()) {
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data successfully deleted']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Request Failed', 'errors' => $symptomRec->getErrorMessages()]);
        }
    }
}