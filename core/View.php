<?php

namespace app\core;

class View
{
    public string $title = '';

    public function renderView($view, $params = []): array|false|string
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($content): array|false|string
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $content, $layoutContent);
    }

    protected function layoutContent(): false|string
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params = []): false|string
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}