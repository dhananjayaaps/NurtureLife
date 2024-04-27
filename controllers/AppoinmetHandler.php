<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
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

    public function cancelAppointment(Request $request, Response $response)
    {
        $appointment = new Appointments();
        $appointment->loadData(Application::$app->request->getBody());
        $appointment->AppointStatus = 0;
        if ($appointment->deleteByAppointmentId()) {
            Application::$app->session->setFlash('success', 'Appointment Cancelled');
            http_response_code(200);
            return json_encode(['message' => 'Cancelled successfully']);
        } else {
            Application::$app->session->setFlash('error', 'Failed to Cancel Appointment');
            http_response_code(400);
            return json_encode(['message' => 'Not Cancelled']);
        }

    }

}