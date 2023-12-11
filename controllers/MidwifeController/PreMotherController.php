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

            if ($mother->validate() && $mother->save()) {
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('midwife/preMother');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'doctor';
        }

        return $this->render('midwife/preMother', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

}