<?php

namespace app\models;

use app\core\Application;
use app\core\ArtistModel;

class Artist extends ArtistModel
{
   
    public string $Name = '';
    public string $Description = '';
    public string $Photo = '';
    public int $User_Id;
    
    public static function tableName(): string
    {
        return 'artist';
    }
    public static function primaryKey(): string
    {
        return 'Id';
    }

    public function saveArtist(): bool
    {
        $this->User_Id = Application::$app->session->get('user');

        return parent::save();
    }

    public function rules(): array
    {
        return [
            'Name' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],

            'Description' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ['Name', 'Description', 'User_Id', 'Photo'];
    }

    public function getArtistName(): string
    {
        return $this->Name;
    }

    public function getDescription(): string
    {
        return $this->Description;
    }
}