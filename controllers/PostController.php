<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\models\Mother;
use app\models\Post;

class PostController extends \app\core\Controller
{
    public function posts(Request $request): array|false|string
    {
        $post = new Post();
        $post2 = new Post();
        if ($request->isPost()) {
            $post->loadData($request->getBody());
                $post->user_id = Application::$app->user->getId();
            if ($post->validate() && $post->save()) {
                Application::$app->session->setFlash('success', 'New Post created successfully');
                Application::$app->response->redirect('/posts');
                exit;
            }
        }

            $roleName = Application::$app->user->getRoleName();
            if ($roleName == 'Doctor'){
                $this->layout = 'doctor';
                return $this->render('doctor/post',  [
                    'model' => $post, "modelUpdate" => $post2
                ]);
            }
            else if ($roleName == 'Midwife'){
                $this->layout = 'midwife';
                return $this->render('midwife/post', [
            'model' => $post, "modelUpdate" => $post2
        ]);
            }
            else if ($roleName == 'Prenatal Mother'){
                $this->layout = 'mother';
                return $this->render('preMother/post', [
            'model' => $post, "modelUpdate" => $post2
        ]);
            }
            else if ($roleName == 'Postnatal Mother'){
                $this->layout = 'mother';
                return $this->render('postMother/post', [
            'model' => $post, "modelUpdate" => $post2
        ]);
            }
            else if ($roleName == 'Volunteer'){
                $this->layout = 'volunteer';
                return $this->render('volunteer/post', [
            'model' => $post, "modelUpdate" => $post2
        ]);
            }
            else{
                return $this->render('/');
            }

    }

    public function postsUpdate(Request $request): false|string
    {
        $post = (new Post())->getAPost($request->getBody()['id']);
        $this->setLayout('mother');
        $post->loadData($request->getBody());
        $post->validate();
        if ($post->validate()) {
            $post->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Post updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $post->getErrorMessages()]);
        }
    }

    public function postDelete(Request $request): false|string
    {
        $post = new Post();
        $post->id = $request->getBody()['id'];
        if ($post->delete()) {
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Post deleted successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Request Failed', 'errors' => $post->getErrorMessages()]);
        }
    }

    public function getPostDetails(Request $request): string
    {
        $post = new Post();
        $post->loadData($request->getBody());
        return $post->getPostById($post->getId());
    }
}