<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\core\Model;

class RoleRequest extends DbModel
{
    const STATUS_PENDING = 0;
    const int STATUS_ATTENDED = 1;
    const int STATUS_COMPLETED = 2;
    public string $id = '';
    public string $user_id = '';
    public string $name ='';
    public string $nic ='';
    public string $SLMC_no = '';
    public string $requested_role = '';
    public string $created_at = '';

    public int $status = self::STATUS_PENDING;

    public function tableName(): string
    {
        return 'roleRequest';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_PENDING;
        $this->user_id = Application::$app->user->getId();
        $this->nic = Application::$app->user->getNIC();
        $this->created_at = date('Y-m-d H:i:s');
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'SLMC_no' => [self::RULE_REQUIRED,[
                self::RULE_UNIQUE ,'class' => self::class
            ]],
            'requested_role' => [self::RULE_REQUIRED]
        ];
    }

    public function getRoleRequestsList(): array
    {
        $roleRequests = (new RoleRequest())->findAll(RoleRequest::class);
        $data = [];
        foreach ($roleRequests as $roleRequest) {
            $data[] = [
                'id' => $roleRequests->id,
                'user_id' => $roleRequests->user_id,
                'name' => $roleRequests->name,
                'nic' => $roleRequests->nic,
                'SLMC_no' => $roleRequests->SLMC_no,
                'requested_role' => $roleRequests->requested_role,
                'created_at' => $roleRequests->created_at,
                'status' => $roleRequests->status
            ];
        }
        return ($data);
    }

    public function getRoleRequests(): string
    {
        $roleRequestData = [];
        if(Application::$app->user->getRoleName() == 'Volunteer'){
            $roleRequestData = (new RoleRequest())->findAll(self::class, ['user_id' => Application::$app->user->getId()]);
            return json_encode($roleRequestData);

        }else if(Application::$app->user->getRoleName() == 'Admin'){
            $roleRequestData = (new RoleRequest())->findAll(self::class);
            return json_encode($roleRequestData);
        }
        return json_encode($roleRequestData);
    }


    public function getRoleRequestById($RoleRequestId): string
    {
        $this->id = $RoleRequestId;
        $roleRequestData = (new RoleRequest())->findOne(self::class, ['id' => $RoleRequestId]);

        $data = [
            'id' => $roleRequestData->id,
            'user_id' => $roleRequestData->user_id,
            'name' => $roleRequestData->name,
            'nic' => $roleRequestData->nic,
            'SLMC_no' => $roleRequestData->SLMC_no,
            'created_at' => $roleRequestData->created_at,
            'status' => $roleRequestData->status
        ];
        return json_encode($data);
    }

    public function getARoleRequest($RoleRequestId)
    {
        return (new RoleRequest())->findOne(self::class, ['id' => $RoleRequestId]);
    }

    public function attributes(): array
    {
        return ['user_id',	'name',	'nic',	'SLMC_no',	'requested_role',	'created_at',   'status'];
    }

    public function update() : bool
    {
        return parent::update();
    }
}