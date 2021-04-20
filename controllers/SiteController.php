<?php

namespace app\controllers;

use app\core\Controller;

/**
 * Class SiteController
 * @package app\controllers
 */

class SiteController extends Controller
{
    public function home()
    {
        $params = [

        ];
        return $this->render('home', $params);

    }



    public function artists()
    {
        $params = [

        ];
        return $this->render('artists', $params);

    }

    public function releases()
    {
        $params = [

        ];
        return $this->render('releases', $params);

    }

    public function artistDetail ()
    {
        $params = [

        ];
        return $this->render('artist_detail', $params);

    }

    public function albums ()
    {
        $params = [

        ];
        return $this->render('albums', $params);

    }


}