<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Mother;

class PreMotherController extends Controller
{
    public function PreMother(Request $request): array|false|string
    {
        $this->layout = 'doctor';
        $mother = new Mother();
        $mother2 = new Mother();

        if ($request->isPost()) {
            $this->layout = 'doctor';
            $mother->loadData($request->getBody());

            var_dump($mother->validate());
            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('midwife/preMotherForm');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'doctor';
        }

        return $this->render('midwife/preMotherForm', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

    public function PreMotherForm1(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $mother = new Mother();
        $mother2 = new Mother();

        if ($request->isPost()) {
            $this->layout = 'midwife';
            $mother->loadData($request->getBody());

            var_dump($mother->validate());
            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('midwife/preMotherForm1');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/preMotherForm1', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

}