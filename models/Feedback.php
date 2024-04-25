<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Feedback extends DbModel
{
    public string $id = '';
    public string $email = '';
    public string $feedback ='';
    public string $created_at = '';

    public function tableName(): string
    {
        return 'feedback';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'feedback' => [self::RULE_REQUIRED]
        ];
    }

    public function getFeedbackList(): array
    {
        $feedbacks = (new Feedback())->findAll(Feedback::class);
        $data = [];
        foreach ($feedbacks as $feedback) {
            $data[] = [
                'id' => $feedback->id,
                'email' => $feedback->email,
                'feedback' => $feedback->feedback,
                'created_at' => $feedback->created_at
            ];
        }
        return ($data);
    }

//    public function getPosts(): string
//    {
//        if(Application::$app->user->getRoleName() == 'Volunteer'){
//            $joins = [
//                ['model' => User::class, 'condition' => 'post.user_id = users.id'],
//            ];
//            $postData = (new Post())->findAllWithJoins(self::class, $joins, ['postal_code' => Application::$app->user->getZip()]);
//
//        }else{
//            $postData = (new Post())->findAll(self::class, ['user_id' => Application::$app->user->getId()]);
//        }
//        $data = [];
//
//        foreach ($postData as $post) {
//            $data[] = [
//                'id' => $post->id,
//                'user_id' => $post->user_id,
//                'description' => $post->description,
//                'created_at' => $post->created_at,
//                'updated_at' => $post->updated_at,
//                'status' => $post->status
//            ];
//        }
//        return json_encode($data);
//    }

//    public function getPostById($PostId): string
//    {
//        $this->id = $PostId;
//        $postData = (new Post())->findOne(self::class, ['id' => $PostId]);
//
//        $data = [
//            'id' => $postData->id,
//            'user_id' => $postData->user_id,
//            'description' => $postData->description,
//            'created_at' => $postData->created_at,
//            'updated_at' => $postData->updated_at,
//            'status' => $postData->status
//        ];
//        return json_encode($data);
//    }

//    public function getAPost($PostId)
//    {
//        return (new Post())->findOne(self::class, ['id' => $PostId]);
//    }

    public function attributes(): array
    {
        return ['email', 'feedback', 'created_at'];
    }

//    public function update() : bool
//    {
//        return parent::update();
//    }

}