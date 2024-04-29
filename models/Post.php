<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Post extends DbModel
{

    const STATUS_PENDING = 0;
    const STATUS_ATTENDED = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_DELETED = 2;

    public string $id = '';

    public string $user_id = '';
    public string $topic ='';
    public string $description ='';
    public string $created_at = '';
    public string $updated_at = '';

    public int $status = self::STATUS_PENDING;

    public function tableName(): string
    {
        return 'post';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_PENDING;
        $this->user_id = Application::$app->user->getId();
        $this->created_at = date('Y-m-d H:i:s');
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'topic' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED]
        ];
    }

    public function getPostsList(): array
    {
        $posts = (new Post())->findAll(Post::class);
        $data = [];
        foreach ($posts as $post) {
            $data[] = [
                'id' => $post->id,
                'user_id' => $post->user_id,
                'topic' => $post->topic,
                'description' => $post->description,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'status' => $post->status
            ];
        }
        return ($data);
    }

    public function getPosts(): string
    {
        if(Application::$app->user->getRoleName() == 'Volunteer' || Application::$app->user->getRoleName() == 'Midwife'){
            $joins = [
                ['model' => User::class, 'condition' => 'post.user_id = users.id'],
            ];
            $postData = (new Post())->findAllWithJoins(self::class, $joins, ['postal_code' => Application::$app->user->getZip()],['postStatus'=>'post.status','post_id'=>'post.id']);

        }else{
            $postData = (new Post())->findAll(self::class, ['user_id' => Application::$app->user->getId()]);
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
        if(Application::$app->user->getRoleName() == 'Volunteer' || Application::$app->user->getRoleName() == 'Midwife'){
            foreach ($postData as $post) {
                $res = (new Post_request())->findOne(Post_request::class, ['post_id'=>$post->post_id,'provider_id' => Application::$app->user->getId(),'seeker_id'=>$post->user_id,'status'=>1]);
                if(empty($res)){
                    $post->contact_no='';
                    $post->email='';
                }

                $data[] = [
                    'id' => $post->post_id,
                    'user_id' => $post->user_id,
                    'user_name'=>$post->firstname.' '.$post->lastname,
                    'role_name'=>$roleMap[$post->role_id-1],
                    'topic' => $post->topic,
                    'description' => $post->description,
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                    'status' => $post->postStatus,
                    'contact_no' => $post->contact_no,
                    'email' => $post->email
                ];
            }
        }else {
            foreach ($postData as $post) {
                $data[] = [
                    'id' => $post->id,
                    'user_id' => $post->user_id,
                    'topic' => $post->topic,
                    'description' => $post->description,
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                    'status' => $post->status
                ];
            }
        }
        return json_encode($data);
    }


    public function getPostById($PostId): string
    {
        $this->id = $PostId;
        $postData = (new Post())->findOne(self::class, ['id' => $PostId]);

        $data = [
            'id' => $postData->id,
            'user_id' => $postData->user_id,
            'topic' => $postData->topic,
            'description' => $postData->description,
            'created_at' => $postData->created_at,
            'updated_at' => $postData->updated_at,
            'status' => $postData->status
        ];
        return json_encode($data);
    }

    public function getAPost($PostId)
    {
        return (new Post())->findOne(self::class, ['id' => $PostId]);
    }

    public function attributes(): array
    {
        return ['user_id','topic', 'description', 'status'];
    }

    public function update() : bool
    {
        return parent::update();
    }
}