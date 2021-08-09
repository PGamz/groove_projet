<?php

namespace app\core;

use app\core\db\DbModel;

abstract class AlbumModel extends DbModel
{
    abstract public function getAlbumTitle(): string;
    abstract public function getAlbumGenre(): string;

    ////PUBLIC PAGES
    //Releases page
    public static function getAlbums(): array
    {
        $statement = self::prepare("SELECT artist.Name As a_Name, album.Title AS alb_Title,album.Id AS alb_Id, Cover, ReleaseDate, Genre FROM album 
                                        INNER JOIN artist ON artist.User_Id = album.User_Id
                                        ORDER BY ReleaseDate DESC ");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getArtistReleases(int $id): array
    {
        $statement = self::prepare("SELECT artist.Name As a_Name, artist.Id AS a_Id, album.Title AS alb_Title,album.Id AS alb_Id, Cover, ReleaseDate, Genre FROM album 
                                        INNER JOIN artist ON artist.User_Id = album.User_Id
                                        WHERE artist.Id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAlbumDetail($id)
    {
        $statement = self::prepare("SELECT artist.Name As a_Name, album.Title AS alb_Title,album.Id AS alb_Id, Cover, ReleaseDate, Genre, track.Id AS track_Id , track.Title AS track_Title, Audio FROM album 
                                        INNER JOIN artist ON artist.User_Id = album.User_Id 
                                        LEFT OUTER JOIN track ON track.User_Id = album.User_Id 
                                        WHERE album.Id = :id");

        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    //////USER PAGES
    ///
    ///
    public static function getArtistAlbums(int $id): array
    {
        $statement = self::prepare("SELECT user.Id as u_Id, artist.Id as a_Id, 
                                        artist.Name As a_Name ,Photo, Description, artist.Name As a_Name, album.Id as alb_Id, album.Title AS alb_Title, Cover, ReleaseDate, Genre 
                                    FROM artist                                   
                                                  
                                    INNER JOIN album ON artist.User_Id = album.User_Id
                                    INNER JOIN user ON artist.User_Id = user.Id  
                                    WHERE artist.User_Id =:id");
        $statement->execute([
            ':id' => $id,
        ]);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getArtistAlbumDetail(int $id): array
    {
        $statement = self::prepare("SELECT artist.Name As a_Name, album.Title AS alb_Title,album.Id AS alb_Id, Cover, ReleaseDate, Genre FROM album 
                                        INNER JOIN artist ON artist.User_Id = album.User_Id
                                        WHERE album.Id = :id");

        $statement->execute([
            ':id' => $id,
        ]);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public static function editAlbum(): array
    {
        if ($_POST) {
            if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['alb_Title']) && !empty($_POST['alb_Title']) && isset($_POST['Genre']) && !empty($_POST['Genre'])) {
                $id = strip_tags($_POST['id']);
                $alb_Title = strip_tags($_POST['alb_Title']);
                $Genre = strip_tags($_POST['Genre']);
                $ReleaseDate = strip_tags($_POST['ReleaseDate']);

                $sql = 'UPDATE `album` 
                        SET `Title`=:alb_Title ,`Genre`=:Genre , `ReleaseDate`=:ReleaseDate
                    
                        WHERE album.Id = :id;';

                $statement = Application::$app->db->pdo->prepare($sql);

                $statement->bindValue(':id', $id, \PDO::PARAM_INT);
                $statement->bindValue(':alb_Title', $alb_Title);
                $statement->bindValue(':Genre', $Genre);
                $statement->bindValue(':ReleaseDate', $ReleaseDate);

                $statement->execute();

                Application::$app->session->setFlash('success', 'Changes saved');
                Application::$app->response->redirect('/artist_albums');
            }
        }

        return self::getArtistAlbumDetail($_GET['id']);
    }

    public static function uploadCover()
    {
        $result = self::getArtistAlbumDetail($_GET['id']);
        $id = $result['alb_Id'];

        if (isset($_POST['submit'])) {
            $file = $_FILES['file'];

            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = ['jpg', 'jpeg', 'png'];

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 2000000) {
                        $fileNameNew = "album" . $id . "." . $fileActualExt;
                        $fileDestination = 'assets/uploads/albums_cover/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $sql = "UPDATE album SET Cover='$fileNameNew' WHERE album.Id ='$id';";

                        $statement = Application::$app->db->pdo->prepare($sql);

                        $statement->execute();

                        Application::$app->session->setFlash('success', 'Success');
                    } else {
                        Application::$app->session->setFlash('error', 'Your file is too big! 2M Max');
                    }
                } else {
                    Application::$app->session->setFlash('error', 'There was an error uploading your file!');
                }
            } else {
                Application::$app->session->setFlash('error', 'File type not accepted!');
            }
        }
        Application::$app->response->redirect('/artist_albums');
    }

    //Delete Album
    public static function deleteAlbum(): array
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `album` WHERE `Id` = :id;';

            $statement = Application::$app->db->pdo->prepare($sql);

            $statement->bindValue(':id', $id, \PDO::PARAM_INT);

            $statement->execute();
        }
        Application::$app->response->redirect('/artist_albums');
        return self::getArtistAlbums(Application::$app->session->get('user'));
    }
}
