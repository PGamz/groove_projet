<?php

namespace app\controllers;

use app\core\AlbumModel;
use app\core\ArtistModel;
use app\core\Controller;
use app\core\EventsModel;
use app\core\SocialModel;
use app\core\TracksModel;

/**
 * Class SiteController
 * @package app\controllers
 */

class SiteController extends Controller
{
    public function home()
    {
        $params = [];
        return $this->render('/home', $params);
    }

    public function artists()
    {
        $artists = ArtistModel::getArtists();

        return $this->render('artists', ['artists' => $artists]);
    }

    public function artistDetail()
    {
        $artist = ArtistModel::getArtistDetail($_GET['id']);
        $albums = AlbumModel::getArtistReleases($_GET['id']);
        $links = SocialModel::getSocial($_GET['id']);
        $events = EventsModel::getEvents($_GET['id']);

        return $this->render('artist_detail', ['artist' => $artist, 'albums' => $albums, 'links' => $links,'events' => $events]);
    }

    public function releases()
    {
        $albums = AlbumModel::getAlbums();

        return $this->render('releases', ['albums' => $albums]);
    }

    public function albumDetail()
    {
        $album = AlbumModel::getAlbumDetail($_GET['id']);

        $tracks = TracksModel::getTracks();

        return $this->render('album', ['album' => $album, 'tracks' => $tracks]);
    }
}
