<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Emergency;
use app\models\Feedback;

class EmergencyController extends Controller
{
    public function emergency(Request $request): array|false|string
    {
        $emergency = new Emergency();
        if ($request->isPost()) {
            $emergency->loadData($request->getBody());
            if ($emergency->validate() && $emergency->save()) {
                Application::$app->session->setFlash('success', 'New emergency alert sent successfully');
                Application::$app->response->redirect('/');
                exit;
            }
        }
        $roleName = Application::$app->user->getRoleName();
        if ($roleName == 'Midwife'){
            $this->layout = 'midwife';
            return $this->render('midwife/emergency',  [
                'model' => $emergency
            ]);
        }
        else if ($roleName == 'Prenatal Mother'){
            $this->layout = 'mother';
            return $this->render('preMother/preMother',  [
                'model' => $emergency
            ]);
        }
        else if ($roleName == 'Postnatal Mother'){
            $this->layout = 'mother';
            return $this->render('postMother/postMother',  [
                'model' => $emergency
            ]);
        }
        else{
            return $this->render('volunteer/emergency', ['model' => $emergency]);
        }
    }
}