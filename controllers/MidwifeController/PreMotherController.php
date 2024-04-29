<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\view;
use app\models\MedicalSurgicalDetails;
use app\models\Mother;
use app\models\PreMotherDetails;
use app\models\PresentObstetricDetails;

class PreMotherController extends Controller
{
    public function PreMother(Request $request): array|false|string
    {
        $mother = new Mother();
        $mother2 = new Mother();

        if ($request->isPost()) {
            $this->layout = 'midwife';
            $mother->loadData($request->getBody());

            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('midwife/Mother');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/preMotherForm', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

    public function preMotherHistoryForm1(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $mother = new PresentObstetricDetails();
        $mother2 = new PresentObstetricDetails();

        if ($request->isPost()) {
            $this->layout = 'midwife';
            $mother->loadData($request->getBody());

            var_dump($mother->validate());
            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('midwife/preMotherHistoryForm1');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/preMotherHistoryForm1', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }
    public function preMotherHistoryForm2(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $mother = new MedicalSurgicalDetails();
        $mother2 = new MedicalSurgicalDetails();

        if ($request->isPost()) {
            $this->layout = 'midwife';
            $mother->loadData($request->getBody());

            var_dump($mother->validate());
            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('midwife/preMotherHistoryForm2');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/preMotherHistoryForm2', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

    public function preMotherHistoryForm3(Request $request): array|false|string
    {
        $this->layout = 'midwife';
        $mother = new MedicalSurgicalDetails();
        $mother2 = new MedicalSurgicalDetails();

        if ($request->isPost()) {
            $this->layout = 'midwife';
            $mother->loadData($request->getBody());

            var_dump($mother->validate());
            if ($mother->validate() && $mother->save()) {
                var_dump($mother);
                Application::$app->session->setFlash('success', 'Added a new Midwife');
                Application::$app->response->redirect('midwife/preMotherHistoryForm3');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/preMotherHistoryForm3', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

    public function personalInformationForm(Request $request): array|false|string
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
                Application::$app->response->redirect('midwife/personalInformationForm');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/personalInformationForm', [
            'model' => $mother, "modelUpdate" => $mother2
        ]);
    }

    public function ChildWeight(Request $request): array|false|string
    {
        $childweight = new ChildWeight();
        $childweight2 = new ChildWeight();
        if ($request->isPost()) {

            $this->setLayout('midwife');
            $childweight->loadData($request->getBody());

            if ($childweight->validate() && $childweight->save()) {
                Application::$app->session->setFlash('success', 'Recorded the child weight');
                Application::$app->response->redirect('/childweight');
                exit;
            }
        } else if ($request->isGet()) {
            $this->layout = 'midwife';

        }
//        var_dump(Application::$app->user->getId());

        return $this->render('midwife/childweight', [
            'model' => $childweight, "modelUpdate" => $childweight2
        ]);
    }

//    public function ChildWeightUpdate(Request $request): false|string
//    {
//        $childweight = (new ChildWeight())->findOneByChildIdAndDate(ChildWeight::class);
//
//        $this->setLayout('midwife');
//        $childweight->loadData($request->getBody());
//        $childweight->validate();
//        if ($childweight->validate()) {
//            $childweight->update();
//            header('Content-Type: application/json');
//            http_response_code(200);
//            return json_encode(['message' => 'Data updated successfully']);
//        } else {
//            header('Content-Type: application/json');
//            http_response_code(400);
//            return json_encode(['message' => 'Validation failed', 'errors' => $childweight->getErrorMessages()]);
//        }
//    }





}