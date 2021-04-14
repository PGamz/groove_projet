<?php


namespace app\models;




use app\core\Model;

class RegisterModel extends  Model
{
    public string  $Firstname ='';
    public string  $Lastname ='';
    public string  $Email ='';
    public string  $Nickname ='';
    public string  $Password ='';
    public string  $Password2 ='';


    public function register()
    {
        echo "Creating new user";
    }

    public function rules(): array
    {
        return [
            'Firstname' => [self::RULE_REQUIRED],
            'Lastname' => [self::RULE_REQUIRED],
            'Email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'Nickname' => [self::RULE_REQUIRED, self::RULE_NICK],
            'Password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'Password2' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'Password']],
        ];
    }

}