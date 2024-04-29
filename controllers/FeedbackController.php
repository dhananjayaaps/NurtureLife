<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Feedback;

class FeedbackController extends Controller
{
    public function feedbacks(Request $request): array|false|string
    {
        $feedback = new Feedback();
        if ($request->isPost()) {
            $feedback->loadData($request->getBody());
            if ($feedback->validate() && $feedback->save()) {
                Application::$app->session->setFlash('success', 'New feedback send successfully');
                Application::$app->response->redirect('/contact');
                exit;
            }
        }
        $roleName = Application::$app->user->getRoleName();
        if ($roleName == 'Admin'){
            $this->layout = 'admin';
            return $this->render('admin/feedbacks',  [
                'model' => $feedback
            ]);
        }
        else{
            $this->setLayout('volunteer');
            return $this->render('contact', ['model' => $feedback]);
        }
    }
}