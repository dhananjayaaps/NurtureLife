<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Session;
use app\models\LoginModel;
use app\models\User;
use app\models\UserRole;
use app\models\UserRoles;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new \app\core\middlewares\AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginModel = new LoginModel();
        $this->setLayout('auth');
        if ($request->isPost()) {
            $loginModel = new LoginModel();
            $loginModel->loadData($request->getBody());

            if ($loginModel->validate() && $loginModel->login()) {
                $response->redirect('/');
                Application::$app->session->setFlash('success', 'You are successfully logged in');
                return true;
            }
        }

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

    public function profile(Request $request, Response $response)
    {
        $this->setLayout('main');
        $user = new User();

        if ($request->isPost()) {
            $user = new User();
            $user->loadData($request->getBody());

            if ($user->validate() && $user->update()) {
                Application::$app->session->setFlash('success', 'Account updated successfully');
                Application::$app->response->redirect('profile');
                exit;
            }
            return $this->render('register',[
                'model' => $user
            ]);
        }

        $user->loadData($user->findOne(User::class , ['id' => Application::$app->user->getId()]));
        return $this->render('profile',[
        'model' => $user
        ]);
    }
}