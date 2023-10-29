<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if($position === false){
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function isPut()
    {
        return $this->method() === 'put';
    }

    public function getBody(){
        $body = [];
        if($this->method() === 'get'){
            foreach($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->method() === 'post'){
            foreach($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $input = file_get_contents('php://input');
            $body = json_decode($input, true);

            if ($body === null) {
                http_response_code(400);
                echo json_encode(array("message" => "Invalid JSON data"));
            }
        }

        return $body;
    }

}