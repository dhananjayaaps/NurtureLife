<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\view;
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

    public function childCard(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new Child();

        if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        if ($request->isPost()) {
//            $child = $child->getChild(1);

            $child->loadData($request->getBody());
            if ($child->update()) {
                var_dump($child);
                Application::$app->session->setFlash('success', 'Submit first health care form');
                Application::$app->response->redirect('midwife/Child');
                exit;
            }
        }

        return $this->render('midwife/childCard', [
            'model' => $child
        ]);
    }

    public function childCard1(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new Child();

        if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        if ($request->isPost()) {
//            $child = $child->getChild(1);

            $child->loadData($request->getBody());
            if ($child->update()) {
                var_dump($child);
                Application::$app->session->setFlash('success', 'Submit second health care form');
                Application::$app->response->redirect('midwife/Child');
                exit;
            }
        }

        return $this->render('midwife/childCard1', [
            'model' => $child
        ]);
    }

    public function childCard2(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $child = new Child();

        if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        if ($request->isPost()) {
//            $child = $child->getChild(1);

            $child->loadData($request->getBody());
            if ($child->update()) {
                var_dump($child);
                Application::$app->session->setFlash('success', 'Submit thirs health care form');
                Application::$app->response->redirect('midwife/Child');
                exit;
            }
        }

        return $this->render('midwife/childCard2', [
            'model' => $child
        ]);
    }

}