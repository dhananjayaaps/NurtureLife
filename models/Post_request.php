<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Post_request extends DbModel
{

    const STATUS_WAITING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;

    public string $id = '';
    public string $post_id = '';
    public string $provider_id = '';
    public string $seeker_id = '';
    public string $description ='';
    public string $created_at = '';
    public string $updated_at = '';

    public int $status = self::STATUS_WAITING;

    public function tableName(): string
    {
        return 'post_request';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_WAITING;
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'description' => [self::RULE_REQUIRED]
        ];
    }

    public function getRequestsList(): array
    {
        $post_requests = (new Post_request())->findAll(Post::class);
        $data = [];
        foreach ($post_requests as $post_request) {
            $data[] = [
                'id' => $post_request->id,
                'post_id' => $post_request->post_id,
                'provider_id' => $post_request->provider_id,
                'seeker_id' => $post_request->seeker_id,
                'description' => $post_request->description,
                'created_at' => $post_request->created_at,
                'updated_at' => $post_request->updated_at,
                'status' => $post_request->status
            ];
        }
        return ($data);
    }
    public function getRequests(): string
    {

        $joins = [
            ['model' => User::class, 'condition' => 'post_request.provider_id = users.id'],
            ['model' => Post::class, 'condition' => 'post_request.post_id = post.id'],
        ];
        $alias=['postID'=>'post.id',
            'postReqID'=>'post_request.id',
            'post_desc'=>'post.description',
            'req'=>'post_request.description',
            'req_status'=>'post_request.status',
            'post_status'=>'post.status',
            'req_created_at'=>'post_request.created_at',
        ];
        $requestData = (new Post_request())->findAllWithJoins(self::class, $joins, ['seeker_id' => Application::$app->user->getId()],$alias);

//            $requestData = (new Post_request())->findAll(self::class, ['seeker_id' => Application::$app->user->getId()]);
        $roleMap=[
            "user",
            "admin",
            "doctor",
            "prenatal mother",
            "postnatal mother",
            "midwife"
        ];
        $data = [];

        foreach ($requestData as $post_request) {
            $data[] = [
                'id' => $post_request->postReqID,
                'post_id' => $post_request->postID,
                'provider_id' => $post_request->provider_id,
                'seeker_id' => $post_request->seeker_id,
                'description' => $post_request->post_desc,
                'topic' => $post_request->topic,
                'req' => $post_request->req,
                'req_created_at' => $post_request->req_created_at,
                'req_status' => $post_request->req_status,
                'post_status' => $post_request->post_status,
                'vol_name' => ucfirst($post_request->firstname).' '.ucfirst($post_request->lastname),
                'role' => $roleMap[$post_request->role_id-1],
            ];
        }
        return json_encode($data);
    }
    public function getPostRequestById($RequestId): string
    {
        $this->id = $RequestId;
        $requestData = (new Post_request())->findOne(self::class, ['id' => $RequestId]);

        $data = [
            'id' => $requestData->id,
            'post_id' => $requestData->user_id,
            'provider_id' => $requestData->provider_id,
            'seeker_id' => $requestData->seeker_id,
            'description' => $requestData->description,
            'created_at' => $requestData->created_at,
            'updated_at' => $requestData->updated_at,
            'status' => $requestData->status
        ];
        return json_encode($data);
    }

    public function getAPostRequest($RequestId)
    {
        return (new Post_request())->findOne(self::class, ['id' => $RequestId]);
    }

    public function attributes(): array
    {
        return ['post_id','provider_id','seeker_id', 'description', 'status'];
    }

    public function update() : bool
    {
        return parent::update();
    }


}