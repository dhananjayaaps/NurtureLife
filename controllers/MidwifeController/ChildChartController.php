<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Request;
use app\models\ChildHeight;
use app\models\ChildWeight;
use app\models\WeightGainChart;
use app\core\Response;

class ChildChartController extends \app\core\Controller
{
    public function ChildWeight(Request $request): array|false|string
    {
        $childweight = new ChildWeight();
        $childweight2 = new ChildWeight();

        if ($request->isPost()) {
        exit();
            $this->setLayout('midwife');
            $childweight->loadData($request->getBody());

            if ($childweight->validate() && $childweight->save()) {
                Application::$app->session->setFlash('success', 'Recorded the child weight');
                Application::$app->response->redirect('/childweight');
                exit;
            }
            else{
                Application::$app->session->setFlash('error', 'Recorded not created');
                Application::$app->response->redirect('/childweight');
            }
        } else if ($request->isGet()) {
            $this->layout = 'midwife';

        }
//        var_dump(Application::$app->user->getId());

        return $this->render('midwife/childweight', [
            'model' => $childweight, "modelUpdate" => $childweight2
        ]);
    }

    public function ChildWeightUpdate(Request $request)
    {
        $childweight = new ChildWeight();
        $childweight = $childweight->findOneByChildIdAndDate(ChildWeight::class);

        if($childweight){
            $this->setLayout('midwife');

            $childweight->loadData($request->getBody());
            $childweight->child_id = $childweight->getChildId();
            $childweight->value_of_weight = $request->getBody()['UpdateWeightCount'];

            if ($childweight->validate()) {
                $childweight->update();
                Application::$app->response->redirect('/childweight');
            } else {
                Application::$app->response->redirect('/childweight');
                Application::$app->session->setFlash('error', "Can't create");
            }
        }
        else{
            $childweight = new ChildWeight();
            $childweight2 = new ChildWeight();
            $this->setLayout('midwife');
            $childweight->loadData($request->getBody());
            $childweight->child_id = $childweight->getChildId();
            $childweight->validate();

            if ($childweight->validate() && $childweight->save()) {
                Application::$app->response->redirect('/childweight');
                Application::$app->session->setFlash('success', 'Recorded the child weight');
            } else {
                return $this->render('midwife/childweight', [
                    'model' => $childweight, "modelUpdate" => $childweight2
                ]);
                exit;
            }
        }
    }

//    public function ChildHeight(Request $request): array|false|string
//    {
//        $childheight = new ChildHeight();
//        $childheight2 = new ChildHeight();
//        if ($request->isPost()) {
//
//            $this->setLayout('midwife');
//            $childheight->loadData($request->getBody());
//
//            if ($childheight->validate() && $childheight->save()) {
//                Application::$app->session->setFlash('success', 'Recorded the child height');
//                Application::$app->response->redirect('/childHeight');
//                exit;
//            } else{
//                var_dump("100");
//                exit();
//                return $this->render('midwife/childHeight', [
//                    'model' => $childheight, "modelUpdate" => $childheight2
//                ]);
//            }
//        } else if ($request->isGet()) {
//            $this->layout = 'midwife';
//        }
//        return $this->render('midwife/childHeight', [
//            'model' => $childheight, "modelUpdate" => $childheight2
//        ]);
//    }

    public function ChildHeightUpdate(Request $request): false|string
    {
        $childheight = (new ChildHeight())->findOneByChildIdAndDate(ChildHeight::class);

        $this->setLayout('midwife');
        $childheight->loadData($request->getBody());
        $childheight->validate();
        if ($childheight->validate()) {
            $childheight->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $childheight->getErrorMessages()]);
        }
    }
}
