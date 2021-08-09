<?php

namespace app\core;

use app\core\db\DbModel;

abstract class SocialModel extends DbModel
{
    abstract public function getSocialName(): string;
    abstract public function getSocialUrl(): string;

    //SITE CONTROLLER FUNCTIONS

    //artists view
    public static function getSocial(int $id): array
    {
        $statement = self::prepare("SELECT artist.Name As a_Name,social.Id AS s_Id, social.Name AS s_Name, Url FROM  social
                                        INNER JOIN artist ON artist.User_Id = social.User_Id
                                        WHERE artist.Id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    //ARTIST CONTROLLER FUNCTIONS

    //artist profile

    public static function getArtistlinks($id): array
    {
        $statement = self::prepare("SELECT artist.Name As a_Name,social.Id AS s_Id, social.Name AS s_Name, Url FROM  social
                                        INNER JOIN artist ON artist.User_Id = social.User_Id
                                        WHERE artist.User_Id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getLink(int $id): array
    {
        $statement = self::prepare("SELECT social.Id AS s_Id, social.Name AS s_Name, Url FROM  social
                                        INNER JOIN artist ON artist.User_Id = social.User_Id
                                        WHERE social.Id = :id");

        $statement->execute([
            ':id' => $id,
        ]);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public static function editLink(): array
    {
        if ($_POST) {
            if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['s_Name']) && !empty($_POST['s_Name']) && isset($_POST['Url']) && !empty($_POST['Url'])) {
                $id = strip_tags($_POST['id']);
                $Name = strip_tags($_POST['s_Name']);
                $Url = strip_tags($_POST['Url']);

                $sql = 'UPDATE `social` 
                        SET `Name`=:s_Name ,`Url`=:Url
                    
                        WHERE social.Id = :id;';

                $statement = Application::$app->db->pdo->prepare($sql);

                $statement->bindValue(':id', $id, \PDO::PARAM_INT);
                $statement->bindValue(':s_Name', $Name);
                $statement->bindValue(':Url', $Url);

                $statement->execute();

                Application::$app->session->setFlash('success', 'Changes saved');
                Application::$app->response->redirect('/artist_profile');
            }
        }

        return self::getLink($_GET['id']);
    }

    public static function deleteLink(): array
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `social` WHERE `Id` = :id;';

            $statement = Application::$app->db->pdo->prepare($sql);

            $statement->bindValue(':id', $id, \PDO::PARAM_INT);

            $statement->execute();
        }

        return self::getArtistlinks(Application::$app->session->get('user'));
    }
}
