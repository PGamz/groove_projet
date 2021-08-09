<?php

namespace app\models;

use app\core\AlbumModel;
use app\core\Application;
use app\core\TracksModel;

class Tracks extends TracksModel
{
    public string $Title = '';
    public string $Audio = '';
    public string $Url = '';
    public int $User_Id;
    public int $Album_Id;

    public static function tableName(): string
    {
        return 'track';
    }

    public static function primaryKey(): string
    {
        return 'Id';
    }
    public function saveTrack(): bool
    {
        $this->User_Id = Application::$app->session->get('user');
        $result = AlbumModel::getArtistAlbumDetail($_GET['id']);
        $this->Album_Id = $result['alb_Id'];
        $this->Audio = self::uploadAudio($_FILES['Audio']);

        return parent::save();
    }
    public function rules(): array
    {
        return [
            'Title' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
        ];
    }
    public function attributes(): array
    {
        return ['Id', 'Title', 'Audio', 'User_Id', 'Url','Album_Id'];
    }
}
