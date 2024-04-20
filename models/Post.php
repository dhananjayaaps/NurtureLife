<?php

namespace app\models;

use app\core\db\DbModel;

class Post extends DbModel
{
    const int STATUS_INACTIVE = 0;
    const int STATUS_ACTIVE = 1;
    const int STATUS_DELETED = 2;
    public string $id = '';

    public string $user_id = '';
    public string $description ='';
    public string $created_at = '';
    public string $updated_at = '';

    public int $status = self::STATUS_INACTIVE;

    public function tableName(): string
    {
        return 'posts';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_ACTIVE;
        return parent::save();
    }

    public function rules(): array
    {
        return [
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
        $postData = (new Post())->findAll(self::class);
        $data = [];

        foreach ($postData as $post) {
            $data[] = [
                'id' => $post->id,
                'user_id' => $post->user_id,
                'description' => $post->description,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'status' => $post->status
            ];
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
        return ['id', 'user_id', 'description', 'created_at', 'updated_at', 'status'];
    }

    public function update() : bool
    {
        $this->status = self::STATUS_ACTIVE;
        $this->updated_at = date('Y-m-d H:i:s');
        return parent::update();
    }
}