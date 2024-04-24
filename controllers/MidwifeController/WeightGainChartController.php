<?php

namespace app\controllers\MidwifeController;

use app\core\Application;
use app\core\Request;
use app\models\WeightGainChart;
use app\core\Response;

class WeightGainChartController extends \app\core\Controller
{
    public function ChildWeightChart(Request $request): array|false|string
    {
        $weight = new WeightGainChart();

        if ($request->isPost()) {
            $this->setLayout('midwife');
            $weight->loadData($request->getBody());

            if ($weight->validate() && $weight->save()) {
                Application::$app->session->setFlash('success', 'Recorded the weight gain');
                return Application::$app->response->redirect('/weight');
            }
        } else if ($request->isGet()) {
            $this->layout = 'midwife';
        }

        return $this->render('midwife/childWeightChart', [
            'model' => $weight,
            "modelUpdate" => $weight
        ]);
    }

    public function weightGainUpdate(Request $request): false|string
    {
        $weight = WeightGainChart::findOneByMotherIdAndDate($request->getBody()['motherId'], $request->getBody()['date']);

        if (!$weight) {
            return json_encode(['message' => 'Weight gain record not found']);
        }

        $this->setLayout('midwife');
        $weight->loadData($request->getBody());

        if ($weight->validate() && $weight->update()) {
            return json_encode(['message' => 'Data updated successfully']);
        } else {
            return json_encode(['message' => 'Validation failed', 'errors' => $weight->getErrorMessages()]);
        }
    }
}
