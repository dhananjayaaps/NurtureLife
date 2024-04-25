<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Request;
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

    public function ChildWeightUpdate(Request $request): false|string
    {
        $childweight = (new Fetalkick())->findOneByChildIdAndDate(Fetalkick::class);

        $this->setLayout('midwife');
        $childweight->loadData($request->getBody());
        $childweight->validate();
        if ($childweight->validate()) {
            $childweight->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $childweight->getErrorMessages()]);
        }
    }
}
