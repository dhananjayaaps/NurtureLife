<?php

namespace app\controllers\MotherController;

use app\core\Application;
use app\core\Controller;
use app\core\view;
use app\core\Request;
use app\models\Mother;


class PreMotherCareController extends Controller
{
    public function preMotherCareForm1(Request $request): array|false|string
    {
        $this->layout = 'mother';
        $mother = new Mother();
        $mother2 = new Mother();

        if ($request->isPost()) {
            $this->layout = 'mother';
            $mother->loadData($request->getBody());

            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('doctor/Mother');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'doctor';
        }

        return $this->render('preMother/preMotherCareForm1', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

    public function preMotherCareForm2(Request $request): array|false|string
    {
        $this->layout = 'mother';
        $mother = new Mother();
        $mother2 = new Mother();

        if ($request->isPost()) {
            $this->layout = 'mother';
            $mother->loadData($request->getBody());

            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('doctor/Mother');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'doctor';
        }

        return $this->render('preMother/preMotherCareForm2', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

}