<?php


namespace app\models;





use app\core\UserModel;


class User extends  UserModel
{
    const  ADMIN_INACTIVE = 0;
    const  ADMIN_ACTIVE = 1;
    const  ADMIN_SUPER = 2;
    const  ADMIN_DELETED = 3;

    public string  $Firstname ='';
    public string  $Lastname ='';
    public string  $Email ='';
    public string  $Nickname ='';
    public string  $Password ='';
    public string  $Password2 ='';
    public string  $Created_At='';
    public int $Admin = self::ADMIN_INACTIVE;


    public static function tableName(): string
    {
        return 'user';
    }

    public static function primaryKey(): string
    {
        return 'Id';
    }

    public function save(): bool
    {
        $this->Admin = self::ADMIN_INACTIVE;
        $this->Password = password_hash($this->Password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'Firstname' => [self::RULE_REQUIRED],
            'Lastname' => [self::RULE_REQUIRED],
            'Email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'Nickname' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
            'Password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'Password2' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'Password']],

        ];
    }

    public function attributes(): array
    {
        return ['Firstname', 'Lastname', 'Email', 'Nickname', 'Password', 'Created_At','Admin'];
    }

    public function labels(): array
    {
        return [
            'Firstname' => 'First Name',
            'Lastname' => 'Last Name',
            'Email' => 'Email',
            'Nickname' => 'Nickname',
            'Password' => 'Password',
            'Password2' => 'Confirm Password',

        ];
    }

    public function getDisplayName(): string
    {
        return $this->Nickname;
    }



}