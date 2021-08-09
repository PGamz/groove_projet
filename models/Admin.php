<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\core\exception\duplicateException;
use app\core\Model;
use app\core\Session;

class Admin
{
    //Update User
    public static function updateUser()
    {
        if ($_POST) {
            if (
                isset($_POST['id']) &&
                !empty($_POST['id']) &&
                isset($_POST['Firstname']) &&
                !empty($_POST['Firstname']) &&
                isset($_POST['Lastname']) &&
                !empty($_POST['Lastname']) &&
                isset($_POST['Nickname']) &&
                !empty($_POST['Nickname']) &&
                isset($_POST['Email']) &&
                !empty($_POST['Email']) &&
                isset($_POST['Admin']) &&
                !empty($_POST['Admin'])
            ) {
                $id = strip_tags($_POST['id']);
                $firstname = strip_tags($_POST['Firstname']);
                $lastname = strip_tags($_POST['Lastname']);
                $nickname = strip_tags($_POST['Nickname']);
                $email = strip_tags($_POST['Email']);
                $admin = strip_tags($_POST['Admin']);

                $sql = 'UPDATE `user` SET `Firstname`=:Firstname, `Lastname`=:Lastname, `Nickname`=:Nickname, `Email`=:Email,`Admin`=:Admin WHERE `Id` = :id;';

                $statement = Application::$app->db->pdo->prepare($sql);

                $statement->bindValue(':id', $id, \PDO::PARAM_INT);
                $statement->bindValue(':Firstname', $firstname, \PDO::PARAM_STR);
                $statement->bindValue(':Lastname', $lastname, \PDO::PARAM_STR);
                $statement->bindValue(':Nickname', $nickname, \PDO::PARAM_STR);
                $statement->bindValue(':Email', $email, \PDO::PARAM_STR);
                $statement->bindValue(':Admin', $admin, \PDO::PARAM_STR);

                $statement->execute();

                Application::$app->session->setFlash('success', 'User updated');
                Application::$app->response->redirect('/usersList');
            }
        }

        return DbModel::findUser();
    }
    
    //Delete User 
    public static function deleteUser()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `user` WHERE `Id` = :id;';

            $statement = Application::$app->db->pdo->prepare($sql);

            $statement->bindValue(':id', $id, \PDO::PARAM_INT);

            $statement->execute();
            Application::$app->session->setFlash('success', 'User deleted');
            Application::$app->response->redirect('/usersList');
        }

        return DbModel::findUser();
    }

    //Artists List
    public function findArtists(): array
    {
        $statement = Application::$app->db->pdo->prepare("SELECT * FROM user INNER JOIN artist ON user.Id = artist.User_Id");

        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Delete Artist Page
    public function deleteArtist(): array
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `artist` WHERE `Id` = :id;';

            $statement = Application::$app->db->pdo->prepare($sql);

            $statement->bindValue(':id', $id, \PDO::PARAM_INT);

            $statement->execute();
            Application::$app->session->setFlash('success', 'Artist deleted');
        }

        return Admin::findArtists();
    }
}
