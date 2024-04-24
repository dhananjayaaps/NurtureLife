<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Post;

class Feedback extends Controller
{
    public function feedbacks(Request $request): array|false|string
    {
        $feedback = new Feedback();
        if ($request->isPost()) {
            $feedback->loadData($request->getBody());
            if ($feedback->validate() && $feedback->save()) {
                Application::$app->session->setFlash('success', 'New Post created successfully');
                Application::$app->response->redirect('/contact');
                exit;
            }
        }
        $this->setLayout('auth');
        return $this->render('contact', ['model' => $feedback]);
    }

    public function getFeedbackDetails(Request $request): string
    {
        $feedback = new Post();
        $feedback->loadData($request->getBody());
        return $feedback->getPostById($feedback->getId());
    }
}