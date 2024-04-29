<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\view;
use app\models\BabyCare;
use app\models\BabyHealthChart;
use app\models\BabySpecialCare;
use app\models\Child;
use app\models\Immunization;
use app\models\Mother;

class ChildController extends Controller
{
    public function Child(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new Child();

        if ($request->isPost()) {
            $child->loadData($request->getBody());
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

    public function viewChild(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new Child();

        if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/viewChild', [
            'model' => $child
        ]);
    }

    public function ChildCard(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new BabyCare();

        if ($request->isPost()) {
            $child->loadData($request->getBody());
            if ($child->validate() && $child->save()) {
                Application::$app->session->setFlash('success', 'Added a new Child');
                Application::$app->response->redirect('midwife/childCard');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/childCard', [
            'model' => $child
        ]);
    }


    public function ChildCard1(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new BabySpecialCare();

        if ($request->isPost()) {
            $child->loadData($request->getBody());
            if ($child->validate() && $child->save()) {
                Application::$app->session->setFlash('success', 'Added a new Child');
                Application::$app->response->redirect('midwife/childCard1');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/childCard1', [
            'model' => $child
        ]);
    }

    public function ChildCard2(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new BabyHealthChart();

        if ($request->isPost()) {
            $child->loadData($request->getBody());
            if ($child->validate() && $child->save()) {
                Application::$app->session->setFlash('success', 'Added a new Child');
                Application::$app->response->redirect('midwife/childCard2');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/childCard2', [
            'model' => $child
        ]);
    }

    public function ImmunizationCard(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new Immunization();

        if ($request->isPost()) {
            $child->loadData($request->getBody());
            if ($child->validate() && $child->save()) {
                Application::$app->session->setFlash('success', 'Vaccination Card Updated Successfully');
                Application::$app->response->redirect('/immunizationCard');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/immunizationCard', [
            'model' => $child
        ]);
    }


    public function childProfile(): array|false|string
    {
        $roleName = Application::$app->user->getRoleName();

        if ($roleName == 'Doctor') {
            $this->layout = 'doctor';
        } else if ($roleName == 'Midwife') {
            $this->layout = 'midwife';
        } else {
            $this->setLayout('mother');
        }

        return $this->render('child/childProfile');
    }

    public function childsUpdate(Request $request): false|string
    {
        $child = (new Child())->getAChild($request->getBody()['child_id']);
        $this->setLayout('midwife');
        $child->loadData($request->getBody());
        if ($child->validate()) {
            $child->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $child->getErrorMessages()]);
        }
    }

}