<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Session;
use app\models\LoginModel;
use app\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new \app\core\middlewares\AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginModel = new LoginModel();
        if ($request->isPost()) {
            $this->setLayout('auth');
            $loginModel = new LoginModel();
            $loginModel->loadData($request->getBody());

            if ($loginModel->validate() && $loginModel->login()) {
                $response->redirect('/');
                return;
            }
            return $this->render('login',[
                'model' => $loginModel
            ]);
        }
        $this->setLayout('auth');
        return $this->render('login',[
            'model' => $loginModel
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $this->setLayout('auth');
            $user = new User();
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for the registering');
                Application::$app->response->redirect('/');
                exit;
            }
            return $this->render('register',[
                'model' => $user
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register',[
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }
}