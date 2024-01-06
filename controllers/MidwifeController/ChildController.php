<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Child;
use app\models\Mother;

class ChildController extends Controller
{
    public function Child(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new Child();

        if ($request->isPost()) {
            $child->loadData($request->getBody());
            var_dump($child);
            if ($child->validate() && $child->save()) {
                Application::$app->session->setFlash('success', 'Added a new Child');
                Application::$app->response->redirect('midwife/Child');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/Child', [
            'model' => $child
        ]);
    }


}