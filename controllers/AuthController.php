<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Session;
use app\models\EmailVerification;
use app\models\LoginModel;
use app\models\User;
use app\models\UserRoles;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

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

            if ($loginModel->validate()) {
                $status = $loginModel->login();
                if ($status == User::STATUS_INACTIVE) {
                    $loginModel->addError('email', 'This account is not active. Please contact the administrator');
                } else if ($status == User::STATUS_Email_NOT_VERIFIED) {
                    $loginModel->addError('email', 'Email is not verified');
                } else if ($status == -1) {
                    $loginModel->addError('password', 'Password is incorrect');
                } else if ($status == User::STATUS_ACTIVE) {
                    $response->redirect('/');
                    Application::$app->session->setFlash('success', 'You are successfully logged in');
                    return true;
                }
            }
        }

        return $this->render('login',[
            'model' => $loginModel
        ]);
    }

    /**
     * @throws \Exception
     */
    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $this->setLayout('auth');
            $user = new User();
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for the registering');
                (new EmailVerification())->sendOtp($user->email);
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

    public function verifyEmail(Request $request, Response $response): array|false|string|null
    {
        $token = $request->getBody()["token"];

        $valid = (new EmailVerification())->verifyEmail($token);

        if ($valid) {
            $this->setLayout('auth');
            return $this->render('Messages/emailVerify');
        }

        $this->setLayout('auth');
        return $this->render('Messages/emailNotVerify');
    }


}