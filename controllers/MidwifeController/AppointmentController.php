<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Appointments;
use app\models\Child;
use app\models\Mother;

class AppointmentController extends Controller
{

    public function ManageAppointments(Request $request, Response $response)
    {
        $this->layout = 'midwife';
        $mother = new Mother();
        $appointment = new Appointments();

        if ($request->isPost()) {

            $requestData = $request->getBody();
            $appointment->loadData($requestData);

            if ($requestData['MotherId'] == "") {
                Application::$app->session->setFlash('error', 'Please select mothers');
                return $this->render('midwife/ManageAppointments', [
                    'model' => $mother, 'appointmentModel' => $appointment
                ]);
            }

            $motherIds = explode(',', $requestData['MotherId']);

            if (empty($requestData['AppointDate'])) {
                $appointment->addError('AppointDate', 'Select a Correct Appointment Date');
            } elseif (strtotime($requestData['AppointDate']) < strtotime(date('Y-m-d'))) {
//                var_dump($appointment);
//                exit();
                $appointment->addError('AppointDate', 'Appointment date cannot be in the past');
            } elseif (empty($requestData['time'])) {
                $appointment->addError('time', 'Select a Correct Appointment Time');
            }else{
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
        }

        $this->layout = 'midwife';
        return $this->render('midwife/ManageAppointments', [
            'model' => $mother, 'appointmentModel' => $appointment
        ]);
    }
}