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

    public function ManageAppointments(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $mother = new Mother();
        $appointment = new Appointments();

        if ($request->isPost()) {
            $mother->loadData($request->getBody());
            if ($mother->validate() && $mother->save()) {
                Application::$app->session->setFlash('success', 'Added a new Child');
                Application::$app->response->redirect('midwife/Child');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/ManageAppointments', [
            'model' => $mother, 'appointmentModel' => $appointment
        ]);
    }

}