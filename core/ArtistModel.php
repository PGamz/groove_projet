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
    public static function getArtistDetail(int $id): array
    {
        $statement = self::prepare("SELECT Photo, Description, artist.Name As a_Name , social.Name AS s_Name, artist.Id AS a_Id,
                                            Url, album.Id as alb_Id, album.Title AS alb_Title, Cover, ReleaseDate, Genre FROM artist  
                                        LEFT OUTER JOIN social ON artist.User_Id = social.User_Id
                                        LEFT OUTER JOIN album ON artist.User_Id = album.User_Id WHERE artist.Id = :id");

        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetch();
    }

    //ARTIST CONTROLLER FUNCTIONS

    //artist profile
    public static function getArtistProfile(int $id)
    {
        $statement = self::prepare("SELECT user.Id as u_Id, artist.Id as a_Id, artist.User_Id as a_User_Id,artist.name AS a_Name,
                                        Photo, Description, social.Name AS s_Name, Url
                                    FROM artist 
                                    LEFT OUTER JOIN social ON artist.User_Id = social.User_Id
                                    INNER JOIN user ON artist.User_Id = user.Id  
                                    WHERE artist.User_Id =:id ");

        $statement->execute([
            ':id' => $id,
        ]);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public static function editArtist()
    {
        if ($_POST) {
            if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['a_Name']) && !empty($_POST['a_Name']) && isset($_POST['Description']) && !empty($_POST['Description'])) {
                $id = strip_tags($_POST['id']);
                $a_Name = strip_tags($_POST['a_Name']);
                $Description = strip_tags($_POST['Description']);

                $sql = 'UPDATE `artist` SET `Name`=:a_Name ,`Description`=:Description WHERE user_Id = :id;';

                $statement = Application::$app->db->pdo->prepare($sql);

                $statement->bindValue(':id', $id, \PDO::PARAM_INT);
                $statement->bindValue(':a_Name', $a_Name, \PDO::PARAM_STR);
                $statement->bindValue(':Description', $Description, \PDO::PARAM_STR);

                $statement->execute();

                Application::$app->session->setFlash('success', 'Changes saved');
                Application::$app->response->redirect('/artist_profile');
            }
        }

        return self::getArtistProfile(Application::$app->session->get('user'));
    }

    public static function uploadImg()
    {
        $id = Application::$app->session->get('user');

        if (isset($_POST['submit'])) {
            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = ['jpg', 'jpeg'];

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 2000000) {
                        $fileNameNew = "profile" . $id . "." . $fileActualExt;
                        $fileDestination = 'assets/uploads/artists_photo/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $sql = "UPDATE artist SET Photo='$fileNameNew' WHERE `user_Id` = '$id';";

                        $statement = Application::$app->db->pdo->prepare($sql);

                        $statement->execute();

                        Application::$app->session->setFlash('success', 'Photo uploaded with success');
                    } else {
                        Application::$app->session->setFlash('error', 'Your file is too big! 2mb Max');
                    }
                } else {
                    Application::$app->session->setFlash('error', 'There was an error uploading your file!');
                }
            } else {
                Application::$app->session->setFlash('error', 'File type not accepted! jpg / jpeg only!');
            }
            Application::$app->response->redirect('/edit_artist');
        }

        return self::getArtistProfile(Application::$app->session->get('user'));
    }

    public static function deleteArtist(): array
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `artist` WHERE `Id` = :id;';

            $statement = Application::$app->db->pdo->prepare($sql);

            $statement->bindValue(':id', $id, \PDO::PARAM_INT);

            $statement->execute();
        }
        Application::$app->response->redirect('/artist_area');

        return ArtistModel::getArtistProfile(Application::$app->session->get('user'));
    }

}
