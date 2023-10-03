<?php

namespace app\core\middlewares;

use app\core\UserModel;
use app\models\User;

class RoleMiddleware
{
    public function checkRole($requiredRole)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userId = $_SESSION['user_id'];
        $userModel = new User();
        $userRole = $userModel->getUserRole($userId);

        if ($userRole !== $requiredRole) {
            header("Location: /unauthorized");
            exit();
        }
    }
}