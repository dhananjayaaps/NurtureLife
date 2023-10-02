<?php

namespace app\core;


class Application
{
    public static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;

    public static Application $app;
    public Session $session;
    public Controller $controller;
    public Database $db;
    public ?DbModel $user;

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
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        var_dump($primaryValue);
        if($primaryValue)
        {
            $userModel = new $this->userClass();
            $primaryKey = $userModel->primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
        else{
            $this->user = null;
        }
    }

    public function Run()
    {
        $content = $this->router->resolve();
        echo $content;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryKeyValue = $user->{$primaryKey};
        $this->session->set('user',$primaryKeyValue);

    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
