<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\models\AddDoctor;
use app\models\User;

class SiteController extends \app\core\Controller
{
    public function home()
    {
        if (!Application::isGuest()) {
            $userRole = Application::$app->user->getRole();
            if ($userRole == 1) {
                $this->layout = 'auth';
                return $this->render('home');
            }
            else if($userRole == 2){
                $this->layout = 'admin';
                return $this->render('admin/admin');
            }
            else if ($userRole == 3){
                $this->layout = 'doctor';
                return $this->render('doctor/doctor');
            }
            else if ($userRole == 4){
                $this->layout = 'mother';
                return $this->render('preMother/preMother');
            }
            else if ($userRole == 5){
                $this->layout = 'mother';
                return $this->render('postMother/postMother');
            }
            else if ($userRole == 6){
                $this->layout = 'midwife';
                return $this->render('midwife/midwife');
            }
        }
        $this->layout = 'auth';
        return $this->render('home');
    }
//    public function about()
//    {
//        return $this->render('about');
//    }

    public function contact()
    {
        return $this->render('contact');
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'handling submitted data';
    }

    public function changeRole(Request $request, Response $response): void
    {
        var_dump($request->getBody()['role_id']);
        var_dump(Application::$app->user->getId());

        $userModel = Application::$app->user;
//        $userModel->loadData($request->getBody());
        if($userModel->changeRole($request->getBody()['role_id'])){
            Application::$app->session->setFlash('success', 'Role changed successfully');
            $response->redirect('/');
        }
        else{
            $response->redirect('/logout');
        }
    }

    public function doctorClinics()
    {
        $this->layout = 'doctor';
        return $this->render('doctor/clinics');
    }

    public function doctorMothers()
    {
        $this->layout = 'doctor';
        return $this->render('doctor/mothers');
    }
    public function doctorViewSymptoms()
    {
        $this->layout = 'doctor';
        return $this->render('doctor/replySymptoms');
    }
    public function midwifeViewSymptoms()
    {
        $this->layout = 'midwife';
        return $this->render('midwife/checkSymptomReports');
    }

    public function about()
    {
        $this->layout = 'auth';

        return $this->render('about');
    }

    public function preMotherTest()
    {
        $this->layout = 'mother';

        return $this->render('preMother/preMotherTest');
    }
    public function communication()
    {
        $this->layout = 'mother';

        return $this->render('preMother/communication');
    }
}