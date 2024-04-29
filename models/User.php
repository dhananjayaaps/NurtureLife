<?php

/**
 * Class Register
 *
 * @author  Sineth Dhananjaya <dhananjayaaps@gmail.com>
 * @package app\models
 */

namespace app\models;

use app\core\UserModel;
use DateTime;

class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const STATUS_Email_NOT_VERIFIED = 3;
    const STATUS_PHONENO_NOT_VERIFIED = 4;
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_DOCTOR = 3;
    const ROLE_PRE_MOTHER = 4;
    const ROLE_POST_MOTHER = 5;
    const ROLE_MIDWIFE = 6;
    public int $id;
    public string $created_at;

    public string $firstname = '';
    public string $lastname ='';
    public string $email = '';
    public string $nic = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $contact_no = '';
    public string $DOB = '';
    public string $gender = '';
    public int $role_id;
    public string $confirm_password = '';
    public string $home_number = '';
    public string $lane = '';
    public string $city = '';
    public string $postal_code = '';


    public function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }
    public function save(): bool
    {
        $ValidateUser = (new User)->findOne(User::class, ['email' => $this->email]);

        if ($ValidateUser) {
            $this->addError('email', 'Already a user with this email');
            return false;
        }

        $this->status = self::STATUS_Email_NOT_VERIFIED;
        $this->role_id = self::ROLE_USER;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->created_at = date('Y-m-d H:i:s');
        //extracting dob and gender from nic
        $nicDetails = $this->extractFromNic($this->nic);
        $this->DOB = $nicDetails['dob'] ?? '2001-02-04';
        $this->gender = $nicDetails['gender'] ?? 'undefined';
        return parent::save();
    }


    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE ,'class' => self::class
            ]],
            'nic' => [self::RULE_REQUIRED,[self::RULE_MIN,'min' => 10],[self::RULE_MAX,'max' => 12],[
                self::RULE_UNIQUE ,'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN,'min' => 8],[self::RULE_MAX,'max' => 24]],
            'confirm_password' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'password']],
            'home_number' => [self::RULE_REQUIRED],
            'lane' => [self::RULE_REQUIRED],
            'city' => [self::RULE_REQUIRED],
            'postal_code' => [self::RULE_REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['firstname','lastname','email','password','nic', 'status', 'role_id','home_number','lane','city','postal_code', 'contact_no', 'DOB', 'gender', 'created_at'];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getUserData($id)
    {
        return (new User)->findOne(User::class, ['id' => $id]);
    }

    public function getUserRole($userId)
    {
        $user = $this->findOne(User::class, ['id' => $userId]);
        return $user->role;
    }

    public function getRole(): int
    {
        return $this->role_id;
    }

    public function getRoleName(): string
    {
        $roleNames = ['Volunteer','Admin','Doctor','Prenatal Mother','Postnatal Mother','Midwife',];
        return $roleNames[$this->role_id-1];
    }

    public function changeRole($newRoleId): bool
    {
        $validRole = (new UserRoles)->findOne(UserRoles::class, ['user_id' => $this->getId(), 'role_id' => $newRoleId]);
        if($validRole){
            $this->role_id = $newRoleId;
            return($this->update());
        }
        return false;
    }

    public function getUserByNIC($nic)
    {
        return (new User)->findOne(User::class, ['nic' => $nic]);
    }
    public function extractFromNic($nic): array
    {
        $dates = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        //nic length
        $nicLength = strlen($nic);

        $daysOld = (int)substr($nic, 2, 3);
        $daysNew = (int)substr($nic, 4, 3);

        //checking for v at last for old nic
        $checkV = substr_compare($nic, "v", -1) || substr_compare($nic, "V", -1);

        //check for first digit in new nic
        $checkOne = substr($nic, 0, 1) === '1';
        $checkTwo = substr($nic, 0, 1) === '2';

        $isOld = true;
        //validating
        if ($nicLength == 10 && $checkV && ($daysOld <= 366 || ($daysOld >= 501 && $daysOld <= 866))) {
            //this is an old nic
            $isOld = true;
        } else if ($nicLength == 12 && ($checkOne || $checkTwo) && ($daysNew <= 366 || ($daysNew >= 501 && $daysNew <= 866))) {
            //this is an old nic
            $isOld = false;
        }

        $year = ($isOld) ? 1900 + (int)substr($nic, 0, 2) : (int)substr($nic, 0, 4);
        $threeDigitsForDays = ($isOld) ? $daysOld : $daysNew;

        //Validate gender
        $gender = "Male";
        if ($threeDigitsForDays > 500) {
            $threeDigitsForDays -= 500;
            $gender = "Female"; //If day value > 500 it means NIC owner is a female.
        }

        $total = 0;
        $date = $month = 0;
        for ($i = 0; $i <= sizeof($dates); $i++) {
            $total += $dates[$i];
            if ($threeDigitsForDays <= $total) {
                $month = $i + 1; //Get the month
                $date = $threeDigitsForDays - ($total - $dates[$i]); //Get the day
                break;
            }
        }
        $date = new DateTime("$year-$month-$date");
        $dob = $date->format('Y-m-d');
        return ['dob' => $dob, 'gender' => $gender];
    }
    public function getAUser($id)
    {
        return (new User())->findOne(self::class, ['id' => $id]);
    }
    public function getUserById($UserId): string
    {
        $this->id = $UserId;
        $userData = (new User())->findOne(self::class, ['id' => $UserId]);

        $data = [
            'user_id' => $userData->id,
            'name' => $userData->name,
            'email' => $userData->email,
            'status' => $userData->status,
            'contact_no' => $userData->contact_no,
            'role_id' => $userData->role_id
        ];
        return json_encode($data);
    }
    public function getUsers(): string
    {
        $userData = (new User())->findAll(self::class);
        $data = [];

        foreach ($userData as $user) {
            $data[] = [
                'user_id' => $user->id,
                'name' => $user->firstname . ' ' . $user->lastname,
                'email' => $user->email,
                'nic' => $user->nic,
                'status' => $user->status,
                'contact_no' => $user->contact_no,
                'role_id' => $user->role_id
            ];
        }
        return json_encode($data);
    }

    public function userUpdateValidate(): bool
    {
        if($this->status === self::STATUS_ACTIVE || $this->status === self::STATUS_INACTIVE){
            if($this->role_id === self::ROLE_USER || $this->role_id === self::ROLE_ADMIN || $this->role_id === self::ROLE_DOCTOR || $this->role_id === self::ROLE_PRE_MOTHER || $this->role_id === self::ROLE_POST_MOTHER || $this->role_id === self::ROLE_MIDWIFE){
                return true;
            }
            $this->addError('role_id','Invalid Role');
        }
        $this->addError('status','Invalid Status');
        return false;
    }
    public function getZip(): string
    {
        return $this->postal_code;
    }
    public function getUsersByZip($zip): string
    {
        $userData = (new User())->findAll(self::class, ['postal_code' => $zip]);
        $data = [];

        foreach ($userData as $user) {
            $data[] = [
                //TODO: what details of user we need?
                'user_id' => $user->id,
                'name' => $user->firstname . ' ' . $user->lastname,
                'email' => $user->email,
                'email' => $user->email,
                'contact_no' => $user->contact_no,
                'role_id' => $user->role_id
            ];
        }
        return json_encode($data);
    }
    public function getNIC(): int
    {
        return $this->nic;
    }
}