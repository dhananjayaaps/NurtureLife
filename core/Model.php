<?php

namespace app\core;

use DateTime;

abstract class Model
{
    public const string RULE_REQUIRED = 'required';
    public const string RULE_EMAIL = 'email';
    public const string RULE_MIN = 'min';
    public const string RULE_MAX = 'max';
    public const string RULE_MATCH = 'match';
    public const string RULE_UNIQUE = 'unique';

    public function loadData($data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this,$key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public array $errors = [];
    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                // Check if the value is required and not present
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }
                // Check if the value is a valid email
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }
                // Check if the value meets the minimum length requirement
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }
                // Check if the value exceeds the maximum length requirement
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }
                // Check if the value matches another attribute's value
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }
                // Check if the value is unique in the database
                if ($ruleName === self::RULE_UNIQUE) {
                    $classname = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $classname::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                    }
                }
            }
        }
        // Return true if there are no errors
        return empty($this->errors);
    }

    public function addErrorForRule(string $attribute,string $rule,$params = []): void
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value){
            $message = str_replace("{{$key}}",$value,$message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function addError(string $attribute,string $message): void
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MIN => 'Minimum length of this field is {min}',
            self::RULE_MAX => 'Maximum length of this field is {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'This {field} already exists'
        ];
    }

    public function getErrorArray(){

    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError(string $attribute)
    {
        return $this->errors[$attribute][0] ?? false;
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
}