<?php

namespace app\core;


use app\core\db\Database;
use app\core\db\DbModel;
use app\models\UserRoles;
use app\models\User;

class Application
{
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;

    public static Application $app;
    public Session $session;
    public Database $db;
    public ?DbModel $user;
    public ? Controller $controller = null;
    public View $view;
    public UserRoles $userRoles;

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'] ?? '';
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new View();
        $this->userRoles = new UserRoles();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if($primaryValue)
        {
            $userModel = new $this->userClass();
            $primaryKey = $userModel->primaryKey();
            $this->user = $this->userClass::findOne(User::class, [$primaryKey => $primaryValue]);
        }
        else{
            $this->user = null;
        }
    }

    public function Run(): void
    {
        try{
            $content = $this->router->resolve();
            echo $content;
        } catch (\Exception $e){
//            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error',[
                'exception' => $e
            ]);
        }
    }

    public function login(DbModel $user): void
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryKeyValue = $user->{$primaryKey};
        $this->session->set('user',$primaryKeyValue);

    }

    public function logout(): void
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
