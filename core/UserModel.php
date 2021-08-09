<?php


namespace app\core;


use app\core\db\DbModel;

use app\models\User;
use PDO;


abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;

    abstract public function getEmail(): string;


    public function getUsers()
    {
        return self ::findAll();

    }

    public function userProfile(int $id)
    {

        $statement = self ::prepare("SELECT user.Id, Firstname, Lastname, Nickname, Email 
                                            FROM user WHERE Id = :id");
        $statement -> execute([
            ':id' => $id,
        ]);

        return $statement -> fetch();
    }


    public function editProfile()
    {

        if ($_POST) {

            if (isset($_POST['id']) && !empty($_POST['id'])
                && isset($_POST['Firstname']) && !empty($_POST['Firstname'])
                && isset($_POST['Lastname']) && !empty($_POST['Lastname'])
                && isset($_POST['Nickname']) && !empty($_POST['Nickname'])
                && isset($_POST['Email']) && !empty($_POST['Email'])) {


                $id = strip_tags($_POST['id']);
                $firstname = strip_tags($_POST['Firstname']);
                $lastname = strip_tags($_POST['Lastname']);
                $nickname = strip_tags($_POST['Nickname']);
                $email = strip_tags($_POST['Email']);


                $sql = 'UPDATE `user` SET `Firstname`=:Firstname, `Lastname`=:Lastname, `Nickname`=:Nickname, `Email`=:Email WHERE `Id` = :id;';


                $query = Application ::$app -> db -> pdo -> prepare($sql);

                $query -> bindValue(':id', $id, PDO::PARAM_INT);
                $query -> bindValue(':Firstname', $firstname, PDO::PARAM_STR);
                $query -> bindValue(':Lastname', $lastname, PDO::PARAM_STR);
                $query -> bindValue(':Nickname', $nickname, PDO::PARAM_STR);
                $query -> bindValue(':Email', $email, PDO::PARAM_STR);

                $query -> execute();

                Application ::$app -> session -> setFlash('success', 'Changes saved');
                Application ::$app -> response -> redirect('/profile');
            }



        }
        return self::userProfile(Application::$app->session->get('user'));
    }


}