<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        $this->layout = 'auth';
        return $this->render ('login');
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
            var_dump($registerModel->errors);
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