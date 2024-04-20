<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Session;
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
                $this->sendOtp($user->email);
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

    public function generateVerificationLink($email)
    {
        $key = bin2hex(random_bytes(16));
        $encodedEmail = base64_encode($email . ':' . $key);
        return $_ENV['APP_URL'] . '/verify?token=' . $encodedEmail;
    }

    public function verifyEmail(Request $request, Response $response)
    {
        $token = $request->getBody()["token"];
        $decoded = base64_decode($token);
        list($email, $key) = explode(':', $decoded);
        $expected = base64_encode($email . ':' . $key);

        $this->setLayout('auth');
        return $this->render('emailVerify');
//        var_dump($decoded, $expected);
//        if ($decoded === $expected) {
//
//            return $email;
//        }
//        return false;
    }

    public function sendOtp($email): false|int
    {
        $link = $this->generateVerificationLink($email); // Generate verification link
        $mail = new PHPMailer(true);
        var_dump($link);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['SMTP_PORT'];

            //Recipients
            $mail->setFrom($_ENV['MAIL_FROM'], 'NurtureLife');
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Welcome to NurtureLife';
            $mail->Body = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Welcome to NurtureLife</title>
                </head>
                <body>
                    <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                        <h1>Welcome to NurtureLife!</h1>
                        <p>Thank you for joining NurtureLife. We're excited to have you on board!</p>
                        <p>To continue the process, please click the button below:</p>
                        <a href='$link' style='display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px;'>Continue Process</a>
                        <p>If you are unable to click the button, you can also <a href='$link'>click here</a> or copy and paste the following link into your browser:</p>
                        <p>$link</p>
                        <p>If you have any questions or need assistance, feel free to reply to this email.</p>
                        <p>Best regards,<br>NurtureLife Team</p>
                    </div>
                </body>
                </html>
            ";

            $mail->send();
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}