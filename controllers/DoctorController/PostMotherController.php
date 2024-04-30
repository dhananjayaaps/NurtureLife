<?php

namespace app\controllers\DoctorController;

use app\core\Application;
use app\core\Controller;
use app\core\view;
use app\core\Request;
use app\models\Mother;
use app\models\PostMotherDetails;

class PostMotherController extends Controller
{
    public function postMotherForm1(Request $request): array|false|string
    {
        $this->layout = 'doctor';
        $mother = new PostMotherDetails();
        $mother2 = new PostMotherDetails();

        if ($request->isPost()) {
            $this->layout = 'doctor';
            $mother->loadData($request->getBody());

            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('doctor/postMotherForm1');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'doctor';
        }

        return $this->render('doctor/postMotherForm1', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

}