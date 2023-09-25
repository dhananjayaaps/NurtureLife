<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;

class SiteController extends \app\core\Controller
{
    public function home()
    {
        $params = [
            'name' => 'Sineth Dhananjaya'
        ];
        return $this->render('home', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        echo '<pre>';
        var_dump($body);
        echo '</pre>';
        return 'handling submitted data';
    }
}