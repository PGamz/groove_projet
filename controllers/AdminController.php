<?php


namespace app\controllers;

use app\core\Application;
use app\core\exception\AdminException;
use app\core\middlewares\Admin;
use app\core\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new Admin(['dashboard']));
    }


    /**
     * @throws AdminException
     */
    public function admin()
    {
        if(Application::isAdmin()){
            throw new AdminException();

        }

        return $this->adminRender('dashboardView');

    }

    /**
     * @throws AdminException
     */
    public function usersList()
    {

        if(Application::isAdmin()){
            throw new AdminException();

        }
        return $this->adminRender('users');


    }

    /**
     * @throws AdminException
     */
    public function artistList()
    {

        if(Application::isAdmin()){
            throw new AdminException();

        }

        return $this->adminRender('artist');



    }

}