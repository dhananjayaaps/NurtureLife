<?php

namespace app\controllers;
use app\core\Application;
use app\core\Request;
namespace app\controllers\AdminController;
use app\core\Application;
use app\core\Request;
use app\models\Doctor;
use app\models\Clinic;
use app\models\User;
use app\models\UserRoles;

class UsersController extends \app\core\Controller
{
    public function users(Request $request): array|false|string
    {
        $user = new User();
        $user2 = new User();
        if ($request->isPost()) {

            $this->setLayout('admin');
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'New user created successfully');
                Application::$app->response->redirect('/users');
                exit;
            }
        }
        else if ($request->isGet()) {
            $this->layout = 'admin';
        }

        return $this->render('admin/users', [
            'model' => $user, "modelUpdate" => $user2
        ]);
    }

    public function userUpdate(Request $request): false|string
    {


        $user = (new User())->getAUser($request->getBody()['id']);
        $this->setLayout('admin');
        $user->loadData($request->getBody());

        if ($user->userUpdateValidate()) {
            $user->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $user->getErrorMessages()]);
        }
    }

    public function userDelete(Request $request): false|string
    {
        $user = new User();
        $user->id = $request->getBody()['id'];
        if ($user->delete()) {
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Data successfully deleted']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Request Failed', 'errors' => $user->getErrorMessages()]);
        }
    }

    public function getUserDetails(Request $request): string
    {
        $user = new User();
        $user->loadData($request->getBody());
        return $user->getUserById($user->getId());
    }

//    public function reports(): array|false|string
//    {
//        $this->layout = 'admin';
//        return $this->render('admin/reports');
//    }
}