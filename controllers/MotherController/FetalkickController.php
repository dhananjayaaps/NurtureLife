<?php

namespace app\controllers;

namespace app\controllers\MotherController;

use app\core\Application;
use app\core\Request;
use app\models\Fetalkick;
use http\Client\Curl\User;


class FetalkickController extends \app\core\Controller
{
    public function Fetalkick(Request $request): array|false|string
    {
        $fetalkick = new Fetalkick();
        $fetalkick2 = new Fetalkick();
        if ($request->isPost()) {

            $this->setLayout('mother');
            $fetalkick->loadData($request->getBody());

            if ($fetalkick->validate() && $fetalkick->save()) {
                Application::$app->session->setFlash('success', 'Recorded the kick count');
                Application::$app->response->redirect('/fetalkick');
                exit;
            }
        } else if ($request->isGet()) {
            $this->layout = 'mother';

        }
//        var_dump(Application::$app->user->getId());

        return $this->render('preMother/fetalkick', [
            'model' => $fetalkick, "modelUpdate" => $fetalkick2
        ]);
    }

    public function fetalkickUpdate(Request $request): false|string
    {
        $fetalkick = (new Fetalkick())->findOneByMotherIdAndDate(Fetalkick::class);

        $this->setLayout('mother');
        $fetalkick->loadData($request->getBody());
        $fetalkick->validate();
        if ($fetalkick->validate()) {
            $fetalkick->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $fetalkick->getErrorMessages()]);
        }
    }
}