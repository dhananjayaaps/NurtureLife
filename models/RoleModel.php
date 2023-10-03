<?php

namespace app\models;

class RoleModel
{
    public function getRolePermissions($roleId)
    {
        //array with permissions for each role
$permissions = [
            1 => [
                'create_user',
                'update_user',
                'delete_user',
            ],
            2 => [
                'create_user',
                'update_user',
            ],
            3 => [
                'create_user',
                'update_user',
            ],
        ];

    }
}

