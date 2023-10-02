<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];
    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

//        if (is_array($callback)) {
//            Application::$app->controller = new $callback[0]();
//        }
//        return call_user_func($callback, $this->request, $this->response);

        if (is_array($callback) && count($callback) === 2) {
            [$controllerClass, $controllerMethod] = $callback;

            if (method_exists($controllerClass, $controllerMethod)) {
                Application::$app->controller = new $callback[0]();
                $controllerInstance = Application::$app->controller;
                return call_user_func([$controllerInstance, $controllerMethod], $this->request, $this->response);
            }
        }

        $this->response->setStatusCode(404);
        return $this->renderView("_404");
    }


    public function renderView($view, $params = []){
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($content){
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $content, $layoutContent);
    }

    protected function layoutContent() {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params = []) {
        foreach ($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}