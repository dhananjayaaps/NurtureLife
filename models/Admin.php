<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\core\Model;
use PDO;

class Admin extends DbModel
{
    public string $admin_id = '';
    public string $nic = '';
    public string $user_id = '';

    public function rules(): array
    {
        return [
            'nic' => [self::RULE_REQUIRED]
        ];
    }

    public function tableName(): string
    {
        return 'admins';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);


        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        }
        else{
            $exitUser = (new Admin())->getUser($ValidateUser->getId());
            if($exitUser){
                $this->addError('nic', 'That user is already a Admin');
                return false;
            }
            $this->user_id = $ValidateUser->id;

            $userRole = new UserRoles();
            $userRole->role_id = 2;
            $userRole->user_id = $ValidateUser->id;
            $userRole->save();

            return parent::save();
        }
    }

    public function attributes(): array
    {
        return ['user_id'];
    }

    private function getUser($id)
    {
        return (new Admin())->findOne(Admin::class, ['user_id' => $id]);
    }

    public function getAdmins(): string
    {
        $sql = "SELECT admins.admin_id, users.nic, CONCAT(users.firstname, ' ', users.lastname) AS full_name, users.contact_no FROM admins JOIN users ON admins.user_id = users.id";
        $statement = self::prepare($sql);

        $statement->execute();
        $adminData = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($adminData as $admin) {
            $data[] = [
                'admin_id' => $admin->admin_id,
                'nic' => $admin->nic,
                'name' => $admin->full_name,
                'contact' => $admin->contact_no
            ];
        }
        return json_encode($data);
    }

    public function getAAdmin($admin_id)
    {
        return (new Admin())->findOne(self::class, ['$admin_id' => $admin_id]);
    }

    public function delete(): bool
    {
        self::deleteWhere(UserRoles::class, ['user_id' => $this->user_id, 'role_id' => 2]);
        return parent::delete();
    }

}
