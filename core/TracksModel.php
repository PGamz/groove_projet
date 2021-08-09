<?php

namespace app\core;

use app\core\db\DbModel;
use app\models\Tracks;

abstract class TracksModel extends DbModel
{
    ////PUBLIC PAGES
    //Releases page
    public static function getTracks(): array
    {
        $result = AlbumModel::getArtistAlbumDetail($_GET['id']);
        $id = $result['alb_Id'];

        $statement = self::prepare("SELECT album.Title AS alb_Title,album.Id AS alb_Id, Cover, ReleaseDate, Genre, track.Id AS track_Id , track.Title AS track_Title, Audio, artist.Name As a_Name FROM track
                                        INNER JOIN album ON album.Id = track.Album_Id
                                        INNER JOIN artist ON artist.User_Id =track.User_Id
                                        WHERE album.Id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getTrackDetail($id)
    {
        $statement = self::prepare("SELECT album.Title AS alb_Title,album.Id AS alb_Id, Cover, ReleaseDate, Genre, track.Id AS track_Id FROM track
                                        INNER JOIN album ON album.User_Id = track.User_Id
                                        WHERE track.Id = :id");

        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetch();
    }

    public static function uploadAudio(array $file)
    {

        if (isset($file['name'])) {
            $file = $_FILES['Audio'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = ['mpeg', 'mp3', 'wav'];

            if (in_array($fileActualExt, $allowed)) {

                if ($fileError === 0) {
                   
                    if ($fileSize < 2000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'assets/uploads/music/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        

                        Application::$app->session->setFlash('success', 'Success');
                        return $fileNameNew;
                        
                        
                    } else {
                        Application::$app->session->setFlash('error', 'Your file is too big!');
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

    public static function deleteTrack(): array
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `track` WHERE `Id` = :id;';

            $statement = Application::$app->db->pdo->prepare($sql);

            $statement->bindValue(':id', $id, \PDO::PARAM_INT);

            $statement->execute();
        }
        Application::$app->response->redirect('/artist_albums');
        return self::getTracks();
    }
}
