<?php

namespace app\controllers;

use app\core\Application;
use app\core\ArtistModel;
use app\core\Controller;

/**
 * Class SiteController
 * @package app\controllers
 */

class SiteController extends Controller
{
    public function home()
    {
        $params = [];
        return $this->render('home', $params);

    }



        public function artists()
    {
        $artists = ArtistModel::getArtists();

        return $this->render('artists',['artists' => $artists] );

    }



    public function releases()
    {
        $params = [];
        return $this->render('releases', $params);

    }

    public function artistDetail ()
    {
        $artist = ArtistModel::getArtistDetail($_GET['id']);

        return $this->render('artist_detail',['artist' => $artist]) ;

    }




    public function albums ()
    {
        $params = [];
        return $this->render('albums', $params);

    }


}