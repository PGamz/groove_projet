<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

/**
 * Class SiteController
 * @package app\controllers
 */

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "Gogoo"
        ];
        return $this->render('home', $params);

    }
    public function signup()
    {
        return $this->render('signup');
    }

    public function signupData(Request $request)
    {

        return 'Handling submitted data';
    }
}