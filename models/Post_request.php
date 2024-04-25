<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Post_request extends DbModel
{
    const int STATUS_WAITING = 0;
    const int STATUS_ACCEPTED = 1;
    const int STATUS_REJECTED = 2;
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
        if(Application::$app->user->getRoleName() == 'Volunteer'){
            $joins = [
                ['model' => User::class, 'condition' => 'post.user_id = users.id'],
            ];
            $requestData = (new Post_request())->findAllWithJoins(self::class, $joins, ['postal_code' => Application::$app->user->getZip()],['postStatus'=>'post.status']);

        }else{
            $requestData = (new Post_request())->findAll(self::class, ['user_id' => Application::$app->user->getId()]);
        }
        $roleMap=[
            "user",
            "admin",
            "doctor",
            "prenatal mother",
            "postnatal mother",
            "midwife"
        ];
        $data = [];
        if(Application::$app->user->getRoleName() == 'Volunteer'){
            foreach ($requestData as $post_request) {
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
        }else {
            foreach ($requestData as $post_request) {
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