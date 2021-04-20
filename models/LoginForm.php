<?php


namespace app\models;


use app\core\Application;
use app\core\Model;


class LoginForm extends Model
{
    public string $Email = '';
    public string $Password = '';


    public function rules(): array
    {
        return [
            'Email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'Password' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'Email' => 'Your Email',
            'Password' => 'Password',
        ];
    }

    public function login()
    {
        $user = (new User)->findOne(['Email' => $this->Email]);
        if (!$user){
            $this->addError('Email', 'User does not exist with this email');
            return false;
        }

        if (!password_verify($this->Password, $user->Password)) {
        $this->addError('Password', 'Password is incorrect');
        return false;
        }
            return Application::$app->login($user);
    }
}