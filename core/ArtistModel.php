<?php


namespace app\core;


use app\core\db\DbModel;

abstract class ArtistModel extends DbModel
{
    abstract public function getArtistName(): string;
    abstract public function getDescription(): string;



    //SITE CONTROLLER FUNCTIONS


    //artists view
    public static function getArtists(): array
    {
        $statement = self::prepare("SELECT * FROM artist ");
        $statement->execute();


        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    //artist public details view
    public static function getArtistDetail($id): array
    {

        $statement = self::prepare("SELECT Photo, Description, artist.Name As a_Name , social.Name AS s_Name,
                                            Url, event.Name AS e_Name, event.Location AS e_Location, event.Date AS e_Date,
                                            event.Time AS e_Time, live.Title AS l_Title, live.Location AS l_Location, live.Date AS l_Date,
                                            live.Time AS l_Time, album.Id as alb_Id, album.Title AS alb_Title, Cover, ReleaseDate, Genre FROM artist  
                                        LEFT OUTER JOIN social ON artist.Id = social.Artist_Id
                                        LEFT OUTER JOIN event ON artist.Id = event.Artist_Id
                                        LEFT OUTER JOIN live ON artist.Id = live.Artist_Id
                                        LEFT OUTER JOIN album ON artist.Id = album.Artist_Id WHERE artist.Id = :id");

        $statement -> bindValue(':id', $id, \PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetch();
    }

    //AUTH CONTROLLER FUNCTIONS

        //artist profile
    public static function getArtistProfile($id): array
    {

        $query = self::prepare("SELECT user.Id as u_Id, artist.Id as a_Id, 
                                    Photo, Description, artist.Name As a_Name  FROM user 
                                    INNER JOIN artist 
                                    ON user.Id = artist.User_Id 
                                    WHERE artist.User_Id = :id");

        $query->execute([
            ':id' => $id,
        ]);

        return $query->fetch(\PDO::FETCH_ASSOC);
    }


    //ADMIN CONTROLLER FUNCTIONS

    //Artists List
    public static function findArtists(): array
    {

        $statement = self::prepare("SELECT * FROM user INNER JOIN artist ON user.Id = artist.User_Id");


        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }





    //Delete Artist Page
    public static function deleteArtist(): array
    {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `artist` WHERE `Id` = :id;';


            $query = Application::$app->db->pdo-> prepare($sql);


            $query -> bindValue(':id', $id, \PDO::PARAM_INT);


            $query -> execute();
        }

        return self::findArtists();

    }






}