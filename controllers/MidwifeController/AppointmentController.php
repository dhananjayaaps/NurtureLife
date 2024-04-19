<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Appointments;
use app\models\Child;
use app\models\Mother;

class AppointmentController extends Controller
{

    public function ManageAppointments(Request $request)
    {
        $this->layout = 'midwife';
        $mother = new Mother();
        $appointment = new Appointments();

        if ($request->isPost()) {
            $requestData = $request->getBody();
            $motherIds = explode(',', $requestData['MotherIds']);

            foreach ($motherIds as $motherId) {
                $appointment->loadData($requestData);
                $appointment->MotherId = $motherId;
                $appointment->AppointStatus = 1;

                if ($appointment->validate() && $appointment->save()) {
                    Application::$app->session->setFlash('success', 'Added new Appointments');
                } else {
                    var_dump($appointment->errors);
                }
            }

            Application::$app->response->redirect('/ManageAppointments');
            exit;
        }


        else if ($request->isGet()) {
            $this->layout = 'midwife';
            return $this->render('midwife/ManageAppointments', [
                'model' => $mother, 'appointmentModel' => $appointment
            ]);
        }
    }
}