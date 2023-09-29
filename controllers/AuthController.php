<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\LoginModel;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginModel = new LoginModel();
        if ($request->isPost()) {
            $this->setLayout('auth');
            $loginModel = new LoginModel();
            $loginModel->loadData($request->getBody());

            if ($loginModel->validate() && $loginModel->login()) {
                return 'Success';
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
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            $this->setLayout('auth');
            $registerModel = new RegisterModel();
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }
            return $this->render('register',[
                'model' => $registerModel
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register',[
            'model' => $registerModel
        ]);
    }
}