<?php


namespace app\models;


use app\core\Application;
use app\core\ArtistModel;
use app\core\EventsModel;

class Events extends EventsModel
{

    public string $Name = '';
    public string $Location = '';
    public string $Url = '';
    public string $Date = '';
    public string $Time= '';
    public int $User_Id;
    public int $Artist_Id;


    public static function tableName(): string
    {
        return 'event';
    }

    public static function primaryKey(): string
    {
        return 'Id';
    }

    public function saveEvent(): bool
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
            'Date' => [self::RULE_REQUIRED],
            
        ];
    }
    public function attributes(): array
    {
        return ['Id', 'Name','Date','Time','Location','Url', 'User_Id', 'Artist_Id'];
    }



}