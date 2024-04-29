<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\models\Clinic;
use app\models\Mother;
use app\models\Post;
use app\models\Post_request;

class PostRequestController extends \app\core\Controller
{
    public function postRequestUpdate(Request $request): false|string
    {
        $post_req = (new Post_request())->getAPostRequest($request->getBody()['id']);
        $post = (new Post())->getAPost($request->getBody()['post_id']);

//        $this->setLayout('mother');
        $post_req->loadData($request->getBody());
        $post_req->validate();
        if ($post_req->validate()) {
            if($request->getBody()['status'] == 1) {
                $post->status = 1;
                $post->update();
            }
            $post_req->update();
            header('Content-Type: application/json');
            http_response_code(200);
            return json_encode(['message' => 'Post Request updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['message' => 'Validation failed', 'errors' => $post_req->getErrorMessages()]);
        }
    }

    public function createPostRequest(Request $request)
    {
        $post_req = new Post_request();
        $post = new Post();
        $post=$post->getAPost($request->getBody()['post_id']);

        if ($request->isPost()) {

            $post_req->loadData($request->getBody());
            $post_req->seeker_id = $post->user_id;
            $post_req->provider_id = Application::$app->user->getId();
            if ($post_req->validate() && $post_req->save()) {
                header('Content-Type: application/json');
                http_response_code(200);
                return json_encode(['message' => 'Post Request created successfully']);
//                Application::$app->session->setFlash('success', 'New Post created successfully');
//                Application::$app->response->redirect('/posts');
//                exit;
            }
        }
    }

    public function getSeekerContact(Request $request): false|string
    {
        return (new Post_request())->getSeekerContact($request->getBody()['id']);
    }

}