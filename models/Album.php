<?php

namespace app\models;

use app\core\Application;
use app\core\AlbumModel;
use app\core\ArtistModel;

class Album extends AlbumModel
{
    public string $Title = '';
    public string $Genre = '';
    public string $Cover = '';
    public string $ReleaseDate = '';
    public int $User_Id;
    public int $Artist_Id;

    public static function tableName(): string
    {
        return 'album';
    }
    public static function primaryKey(): string
    {
        return 'Id';
    }

    public function saveAlbum(): bool
    {
        $this->User_Id = Application::$app->session->get('user');
        $result = ArtistModel::getArtistDetail($_GET['id']);
        $this->Artist_Id = $result['a_Id'];

        return parent::save();
    }

    public function rules(): array
    {
        return [
            'Title' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
            'Genre' => [self::RULE_REQUIRED],
            'ReleaseDate' => [self::RULE_REQUIRED],
        ];
    }
    
       public function labels(): array
    {
        return [
            'ReleaseDate' => 'Release Date'
        ];
    }

    public function attributes(): array
    {
        return [ 'Title', 'Genre','Cover','ReleaseDate', 'User_Id', 'Artist_Id'];
    }

    public function getAlbumTitle(): string
    {
        return $this->Title;
    }

    public function getAlbumGenre(): string
    {
        return $this->Genre;
    }
}
