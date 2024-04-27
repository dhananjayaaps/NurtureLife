<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\RoleRequest;

class RoleRequestController extends Controller
{
    public function posts(Request $request): array|false|string
    {
        $roleReq = new RoleRequest();
        if ($request->isPost()) {
            $roleReq->loadData($request->getBody());
            $roleReq->user_id = Application::$app->user->getId();
            if ($roleReq->validate() && $roleReq->save()) {
                Application::$app->session->setFlash('success', 'New role requested successfully');
                Application::$app->response->redirect('/roleRequest');
                exit;
            }
        }

        $roleName = Application::$app->user->getRoleName();
        if ($roleName == 'Admin'){
            $this->layout = 'admin';
            return $this->render('admin/roleRequest',  [
                'model' => $roleReq
            ]);
        }
        if ($roleName == 'Volunteer'){
            $this->layout = 'volunteer';
            return $this->render('volunteer/roleRequest',  [
                'model' => $roleReq
            ]);
        }
        else{
            return $this->render('/');
        }

    }

    public function getPostDetails(Request $request): string
    {
        $roleReq = new RoleRequest();
        $roleReq->loadData($request->getBody());
        return $roleReq->getPostById($roleReq->getId());
    }
}