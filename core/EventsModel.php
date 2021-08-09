<?php


namespace app\core;



use app\core\db\DbModel;

abstract class EventsModel extends DbModel
{


    //SITE CONTROLLER FUNCTIONS

    //artists view
    public static function getEvents(int $id): array
    {
        $statement = self::prepare("SELECT artist.Name As a_Name,event.Id AS eve_Id, event.Name AS eve_Name,event.Url AS eve_Url,
                                        Location, event.Date AS eve_Date, event.Time AS eve_Time FROM  event
                                        INNER JOIN artist ON artist.User_Id = event.User_Id
                                        WHERE artist.Id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    //ARTIST CONTROLLER FUNCTIONS

    //artist profile

    public static function getArtistEvents($id): array
    {
        $statement = self::prepare("SELECT artist.Name As a_Name,event.Id AS eve_Id, event.Name AS eve_Name,event.Url AS eve_Url,
                                        Location, event.Date AS eve_Date, event.Time AS eve_Time FROM  event
                                        INNER JOIN artist ON artist.User_Id = event.User_Id
                                        WHERE artist.User_Id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getEvent(int $id): array
    {
        $statement = self::prepare("SELECT artist.Name As a_Name,event.Id AS eve_Id, event.Name AS eve_Name,event.Url AS eve_Url,
                                        Location, event.Date AS eve_Date, event.Time AS eve_Time FROM  event
                                        INNER JOIN artist ON artist.User_Id = event.User_Id
                                        WHERE event.Id = :id");

        $statement->execute([
            ':id' => $id,
        ]);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public static function editEvent(): array
    {
        if ($_POST) {
            if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['eve_Name']) && !empty($_POST['eve_Name'])
                && isset($_POST['eve_Url']) && !empty($_POST['eve_Url']) && isset($_POST['Location']) && !empty($_POST['Location'])
                && isset($_POST['eve_Date']) && !empty($_POST['eve_Date'])&& isset($_POST['eve_Time']) && !empty($_POST['eve_Time'])) {
                $id = strip_tags($_POST['id']);
                $Name = strip_tags($_POST['eve_Name']);
                $Url = strip_tags($_POST['eve_Url']);
                $Location = strip_tags($_POST['Location']);
                $Date = strip_tags($_POST['eve_Date']);
                $Time = strip_tags($_POST['eve_Time']);

                $sql = 'UPDATE `event` 
                        SET `Name`=:eve_Name ,`Url`=:eve_Url, `Location`=:Location ,`Date`=:eve_Date ,`Time`=:eve_Time 
                    
                        WHERE event.Id = :id;';

                $statement = Application::$app->db->pdo->prepare($sql);

                $statement->bindValue(':id', $id, \PDO::PARAM_INT);
                $statement->bindValue(':eve_Name', $Name);
                $statement->bindValue(':eve_Url', $Url);
                $statement->bindValue(':Location', $Location);
                $statement->bindValue(':eve_Date', $Date);
                $statement->bindValue(':eve_Time', $Time);

                $statement->execute();

                Application::$app->session->setFlash('success', 'Changes saved');
                Application::$app->response->redirect('/artist_events');
            }
        }

        return self::getEvent($_GET['id']);
    }

    public static function deleteEvent(): array
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `event` WHERE `Id` = :id;';

            $statement = Application::$app->db->pdo->prepare($sql);

            $statement->bindValue(':id', $id, \PDO::PARAM_INT);

            $statement->execute();
        }

        return self::getArtistEvents(Application::$app->session->get('user'));
    }
}
