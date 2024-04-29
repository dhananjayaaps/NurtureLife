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
        $this->created_at = date('Y-m-d H:i:s');
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

    public function getFeedbackById($FeedbackId): string
    {
        $this->id = $FeedbackId;
        $feedbackData = (new Post())->findOne(self::class, ['id' => $FeedbackId]);

        $data = [
            'id' => $FeedbackId->id,
            'user_id' => $FeedbackId->email,
            'description' => $FeedbackId->feedback,
            'created_at' => $FeedbackId->created_at,
        ];
        return json_encode($data);
    }

    public function attributes(): array
    {
        return ['email', 'feedback', 'created_at'];
    }

    public function getFeedbacks()
    {
        $feedbackData = [];
        if(Application::$app->user->getRoleName() == 'Admin'){
            $feedbackData = (new Feedback())->findAll(self::class);
            return json_encode($feedbackData);
        }
        return json_encode($feedbackData);
    }

}