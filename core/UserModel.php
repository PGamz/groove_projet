<?php


namespace app\core;


use app\core\db\DbModel;
use app\core\exception\AdminException;
use PDO;


abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
    abstract public function getEmail(): string;


    public function getUsers()
    {
        return self::findAll();

    }

    public function userProfile()
    {

            $statement = self::prepare("SELECT user.Id, Firstname, Lastname, Nickname, Email, artist.Id as a_Id, artist.Name 
                                            FROM user 
                                            INNER JOIN artist 
                                            ON user.Id = artist.User_Id");

            $statement -> execute();
            return $statement -> fetch();
    }


    public function updateUser()
    {

        if ($_POST) {

            if (isset($_POST['id']) && !empty($_POST['id'])
                && isset($_POST['Firstname']) && !empty($_POST['Firstname'])
                && isset($_POST['Lastname']) && !empty($_POST['Lastname'])
                && isset($_POST['Nickname']) && !empty($_POST['Nickname'])
                && isset($_POST['Email']) && !empty($_POST['Email'])
            && isset($_POST['Admin']) && !empty($_POST['Admin'])){


                $id = strip_tags($_POST['id']);
                $firstname = strip_tags($_POST['Firstname']);
                $lastname = strip_tags($_POST['Lastname']);
                $nickname = strip_tags($_POST['Nickname']);
                $email = strip_tags($_POST['Email']);
                $admin = strip_tags($_POST['Admin']);


                $sql = 'UPDATE `user` SET `Firstname`=:Firstname, `Lastname`=:Lastname, `Nickname`=:Nickname, `Email`=:Email,`Admin`=:Admin WHERE `Id` = :id;';


                $query = Application::$app->db->pdo->prepare($sql);

                $query -> bindValue(':id', $id, PDO::PARAM_INT);
                $query -> bindValue(':Firstname', $firstname,PDO::PARAM_STR);
                $query -> bindValue(':Lastname', $lastname,PDO::PARAM_STR);
                $query -> bindValue(':Nickname', $nickname,PDO::PARAM_STR);
                $query -> bindValue(':Email', $email,PDO::PARAM_STR);
                $query -> bindValue(':Admin', $admin,PDO::PARAM_STR);

                $query->execute();


                Application::$app->session->setFlash('done','User updated');
                Application::$app->response->redirect('/usersList');
            }

        }

        return self::findUser();

    }

    public function deleteUser()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $sql = 'DELETE FROM `user` WHERE `Id` = :id;';


            $query = Application::$app->db->pdo-> prepare($sql);


            $query -> bindValue(':id', $id, PDO::PARAM_INT);


            $query -> execute();
        }

        return self::findUser();

    }










}