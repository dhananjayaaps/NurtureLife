<?php

namespace app\controllers\AdminController;

use app\core\Application;
use app\core\Request;
use app\models\Clinic;
use app\models\Midwife;
use app\models\User;

class MidwifeController extends \app\core\Controller
{
    public function Midwife(Request $request): array|false|string
    {
        $Midwife = new Midwife();
        $Midwife2 = new Midwife();

        if ($request->isPost()) {
            $this->setLayout('admin');
            $Midwife->loadData($request->getBody());

            if ($Midwife->validate() && $Midwife->save()) {
                Application::$app->session->setFlash('success', 'New midwife created successfully');
                Application::$app->response->redirect('/midwife');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'admin';
        }

        return $this->render('admin/Midwife', [
            'model' => $Midwife, "modelUpdate" => $Midwife2
        ]);
    }

    public function MidwifeUpdate(Request $request): false|string
    {
        $clinicId = $request->getBody()['clinic_id'];
        $Midwife = (new Midwife())->getAMidwife($request->getBody()['PHM_id']);

        if ($Midwife) {
            $Midwife->loadData($request->getBody());
            $Midwife->clinic_id = $clinicId;
            if ($Midwife->update()) {
                header('Content-Type: application/json');
                http_response_code(200);
                return json_encode(['message' => 'Data updated successfully']);
            } else {
                header('Content-Type: application/json');
                http_response_code(400);
                return json_encode(['message' => 'Failed To Update', 'errors' => $Midwife->getErrorMessages()]);
            }
        } else {
            // Handle the case where a Midwife with the given clinic_id was not found.
            header('Content-Type: application/json');
            http_response_code(404);
            return json_encode(['message' => 'Midwife not found']);
        }
    }


    public function MidwifeDelete(Request $request): false|string
    {

        $Midwife = (new Midwife())->getAMidwife($request->getBody()['PHM_id']);
        if ($Midwife->delete()) {
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data successfully deleted']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Request Failed', 'errors' => $Midwife->getErrorMessages()]);
        }
    }

    public function getMidwifeDetails(Request $request): string
    {
        $Midwife = new Midwife();
        $Midwife->loadData($request->getBody());
        return $Midwife->getMidwifeById($Midwife->getId());
    }

}