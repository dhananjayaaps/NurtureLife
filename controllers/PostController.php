<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\models\Post;

class PostController extends \app\core\Controller
{
    public function posts(Request $request): array|false|string
    {
        $post = new Post();
        $post2 = new Post();
        if ($request->isPost()) {

            $this->setLayout('mother');
            $post->loadData($request->getBody());

            if ($post->validate() && $post->save()) {
                Application::$app->session->setFlash('success', 'New Post created successfully');
                Application::$app->response->redirect('/posts');
                exit;
            }
        }
        else if ($request->isGet()) {
            $this->layout = 'mother';
        }

        return $this->render('preMother/posts', [
            'model' => $post, "modelUpdate" => $post2
        ]);
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