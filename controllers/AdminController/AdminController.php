<?php

namespace app\controllers\AdminController;

use app\core\Application;
use app\core\Request;
use app\models\Admin;
use app\models\User;

class AdminController extends \app\core\Controller
{
    public function Admin(Request $request): array|false|string
    {
        $admin = new Admin();
        $admin2 = new Admin();

        if ($request->isPost()) {
            $this->setLayout('admin');
            $admin->loadData($request->getBody());

            if ($admin->validate() && $admin->save()) {
                Application::$app->session->setFlash('success', 'Added a new Admin');
                Application::$app->response->redirect('/ManageAdmins');
                exit;
            }
        }

        else if ($request->isGet()) {
            $this->layout = 'admin';
        }

        return $this->render('admin/ManageAdmins', [
            'model' => $admin, "modelUpdate" => $admin2
        ]);
    }


    public function AdminDelete(Request $request): false|string
    {

        $admin = (new Admin())->getAAdmin($request->getBody()['admin_id']);
        if ($admin->delete()) {
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data successfully deleted']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Request Failed', 'errors' => $admin->getErrorMessages()]);
        }
    }

}