<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;

class SiteController extends \app\core\Controller
{
    public function home()
    {
        if (!Application::isGuest()) {
            $userRole = Application::$app->user->getRole();
            if ($userRole == 1) {
                return $this->render('home');
            }
            else if($userRole == 2){
                return $this->render('admin');
            }
            else if ($userRole == 3){
                return $this->render('doctor');
            }
            else if ($userRole == 4){
                return $this->render('preMother');
            }
            else if ($userRole == 5){
                return $this->render('postMother');
            }
            else if ($userRole == 6){
                return $this->render('midwife');
            }
        }
        return $this->render('home');
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