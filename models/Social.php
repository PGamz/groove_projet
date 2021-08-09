<?php

namespace app\models;

use app\core\Application;
use app\core\ArtistModel;
use app\core\SocialModel;

class Social extends SocialModel
{
    public string $Name = '';
    public string $Url = '';
    public int $User_Id;
    public int $Artist_Id;
    public static function tableName(): string
    {
        return 'social';
    }

    public static function primaryKey(): string
    {
        return 'Id';
    }

    public function saveSocial(): bool
    {
        $this->User_Id = Application::$app->session->get('user');
        $result = ArtistModel::getArtistDetail($_GET['id']);
        $this->Artist_Id = $result['a_Id'];

        return parent::save();
    }

    public function rules(): array
    {
        return [
            'Name' => [self::RULE_REQUIRED],
            'Url' => [self::RULE_REQUIRED],
        ];
    }
    public function attributes(): array
    {
        return ['Id', 'Name', 'Url', 'User_Id', 'Artist_Id'];
    }

    public function getSocialName(): string
    {
        return $this->Name;
    }

    public function getSocialUrl(): string
    {
        return $this->Url;
    }
}
