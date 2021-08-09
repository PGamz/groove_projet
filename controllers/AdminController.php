<?php

namespace app\controllers;

use app\core\Application;
use app\core\exception\AdminException;
use app\core\middlewares\Admin;
use app\core\Controller;

class AdminController extends Controller
{
    /**
     * @throws AdminException
     */
    public function __construct()
    {
        $this->registerMiddleware(new Admin(['dashboard']));

        if (Application::isAdmin()) {
            throw new AdminException();
        }
    }

    public function admin()
    {
        return $this->adminRender('dashboardView');
    }

    public function usersList()
    {
        $users = Application::$app->user->getUsers();

        return $this->adminRender('usersList', ['users' => $users]);
    }

    public function editUser()
    {
        $user = \app\models\Admin::updateUser();

        return $this->adminRender('edit_user', ['user' => $user]);
    }

    public function deleteUser()
    {
        $user = \app\models\Admin::deleteUser();

        return $this->adminRender('delete_user', ['user' => $user]);
    }

    public function artistList()
    {
        $artists = (new \app\models\Admin())->findArtists();

        return $this->adminRender('artistsList', ['artists' => $artists]);
    }

    public function deleteArtist()
    {
        $artists = (new \app\models\Admin())->deleteArtist();

        return $this->adminRender('delete_artist', ['artists' => $artists]);
    }
}
