<?php


namespace app\controllers;

use app\core\Application;
use app\core\ArtistModel;

use app\core\exception\AdminException;
use app\core\middlewares\Admin;
use app\core\Controller;
use app\core\Session;


class AdminController extends Controller
{

    /**
     * @throws AdminException
     */
    public function __construct()
    {
        $this->registerMiddleware(new Admin(['dashboard']));

        if(Application::isAdmin()){
            throw new AdminException();
        }
    }



    public function admin()
    {

        return $this->adminRender('dashboardView');

    }


    public function usersList()
    {

       $users = Application::$app->user->getUsers() ;


       return $this->adminRender('usersList', ['users' => $users]);
    }



    public function editUser()
    {

        $user = Application::$app->user->updateUser();


        return $this->adminRender('edit_user',['user' => $user]);


    }


    public function deleteUser()
    {

        $user = Application::$app->user->deleteUser();

        return $this->adminRender('delete_user', ['user' => $user] );
    }




    public function artistList()
    {

        $artists = ArtistModel::findArtists();

        return $this->adminRender('artistsList',['artists' => $artists] );
        

    }


    public function deleteArtist()
    {
        $artists = ArtistModel::deleteArtist();

        return $this->adminRender('delete_artist',['artists' => $artists] );
    }








}