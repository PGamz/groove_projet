<?php

namespace app\controllers;

use app\core\AlbumModel;
use app\core\Application;
use app\core\ArtistModel;
use app\core\Controller;
use app\core\exception\ArtistException;
use app\core\Request;
use app\core\SocialModel;
use app\core\EventsModel;
use app\core\TracksModel;
use app\models\Album;
use app\models\Artist;
use app\models\Social;
use app\models\Tracks;
use app\models\Events;

class ArtistController extends Controller
{
    /**
     * @throws ArtistException
     */
    public function __construct()
    {
        if (Application::isArtist()) {
            throw new ArtistException();
        }
    }

    public function createArtist(Request $request)
    {
        $artist = new Artist();
        if ($request->isPost()) {
            $artist->loadData($request->getBody());

            if ($artist->validate() && $artist->saveArtist()) {
                Application::$app->session->setFlash('done', 'Artist page published');
                Application::$app->response->redirect('/artist_profile');
            }
            $this->setLayout('artistlayout');
            return $this->artistRender('create_artist', ['model' => $artist]);
        }

        $this->setLayout('artistlayout');
        return $this->artistRender('create_artist', ['model' => $artist]);
    }

    public function artistArea()
    {
        $this->setLayout('artistlayout');
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));

        if ($artist == null) {
            return $this->artistRender('artist_area');
        }

        return $this->artistRender('artist_area', ['artist' => $artist]);
    }

    public function artistProfile()
    {
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $links = SocialModel::getArtistlinks(Application::$app->session->get('user'));

        $this->setLayout('artistlayout');
        return $this->artistRender('artist_profile', ['artist' => $artist, 'links' => $links]);
    }

    public function editArtist()
    {
       
        $items = ArtistModel::editArtist();
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $links = SocialModel::getArtistlinks(Application::$app->session->get('user'));
        $this->setLayout('artistlayout');
        return $this->artistRender('edit_artist', ['items' => $items, 'artist' => $artist,  'links' => $links]);
    }

    public function deleteArtist()
    {
        $artist = ArtistModel::deleteArtist();

        return $this->artistRender('delete_artist_page', ['artist' => $artist]);
    }

    public function addPhoto()
    {
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $img = ArtistModel::uploadImg();
        $this->setLayout('artistlayout');
        return $this->artistRender('artist_photo', ['img' => $img, 'artist' => $artist]);
    }

    //AlBUMS

    public function createAlbum(Request $request)
    {
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $album = new Album();
        if ($request->isPost()) {
            $album->loadData($request->getBody());

            if ($album->validate() && $album->saveAlbum()) {
                Application::$app->session->setFlash('done', 'New album added');
                Application::$app->response->redirect('/artist_albums');
            }
            $this->setLayout('artistlayout');
            return $this->artistRender('create_album', ['model' => $album, 'artist' => $artist]);
        }

        $this->setLayout('artistlayout');
        return $this->artistRender('create_album', [
            'model' => $album,
            'artist' => $artist,
        ]);
    }

    //show albums of logged in Artist
    public function artist_albums()
    {
        $albums = AlbumModel::getArtistAlbums(Application::$app->session->get('user'));
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $this->setLayout('artistlayout');
        return $this->artistRender('artist_albums', ['albums' => $albums, 'artist' => $artist]);
    }

    //edit Album individually
    public function updateArtistAlbum()
    {
        $ualbum = AlbumModel::editAlbum();
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));

        $this->setLayout('artistlayout');
        return $this->artistRender('edit_album', ['ualbum' => $ualbum, 'artist' => $artist]);
    }

    public function albumDetail()
    {
        
        $detail = AlbumModel::getArtistAlbumDetail($_GET['id']);
        $tracks = TracksModel::getTracks();
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $this->setLayout('artistlayout');
        return $this->artistRender('album_detail', ['detail' => $detail, 'artist' => $artist, 'tracks' => $tracks]);
    }

    public function albumCover()
    {
        $cover = AlbumModel::uploadCover();

        $this->setLayout('artistlayout');
        return $this->artistRender('album_detail', ['cover' => $cover]);
    }

    public function deleteAlbum()
    {
        $delAlbum = AlbumModel::deleteAlbum();

        return $this->artistRender('delete_album', ['delAlbum' => $delAlbum]);
    }

    public function createTrack(Request $request)
    {
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $track = new Tracks();
        if ($request->isPost()) {
            $track->loadData($request->getBody());

            if ($track->validate() && $track->saveTrack()) {
                $audioFile = TracksModel::uploadAudio($_FILES['Audio']);

                if ($audioFile) {
                    $_FILES['Audio'] = $audioFile;
                }

                Application::$app->session->setFlash('done', 'New track added');
                Application::$app->response->redirect('/artist_albums');
            }
            $this->setLayout('artistlayout');

            return $this->artistRender('add_track', ['model' => $track, 'artist' => $artist]);
        }

        $this->setLayout('artistlayout');
        return $this->artistRender('add_track', [
            'model' => $track,
            'artist' => $artist,
        ]);
    }

    public function deleteAlbumTrack()
    {
        $delTrack = TracksModel::deleteTrack();

        return $this->artistRender('delete_track', ['delTrack' => $delTrack]);
    }

    public function createSocial(Request $request)
    {
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $social = new Social();
        if ($request->isPost()) {
            $social->loadData($request->getBody());

            if ($social->validate() && $social->saveSocial()) {
                Application::$app->session->setFlash('done', 'New link added');
                Application::$app->response->redirect('/artist_profile');
            }
            $this->setLayout('artistlayout');
            return $this->artistRender('add_link', ['model' => $social, 'artist' => $artist]);
        }

        $this->setLayout('artistlayout');
        return $this->artistRender('add_link', [
            'model' => $social,
            'artist' => $artist,
        ]);
    }

    public function editSocial()
    {
        $link = SocialModel::editLink();
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));

        $this->setLayout('artistlayout');
        return $this->artistRender('edit_link', ['link' => $link, 'artist' => $artist]);
    }

    public function deleteSocial()
    {
        $delLink = SocialModel::deletelink();

        return $this->artistRender('delete_link', ['delLink' => $delLink]);
    }

    public function createEvent(Request $request)
    {
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));
        $event = new Events();
        if ($request->isPost()) {
            $event->loadData($request->getBody());

            if ($event->validate() && $event->saveEvent()) {
                Application::$app->session->setFlash('done', 'New event added');
                Application::$app->response->redirect('/artist_events');
            }
            $this->setLayout('artistlayout');
            return $this->artistRender('add_event', ['model' => $event, 'artist' => $artist]);
        }

        $this->setLayout('artistlayout');
        return $this->artistRender('add_event', [
            'model' => $event,
            'artist' => $artist,
        ]);
    }
    public function artistEvents()
    {
        $events = EventsModel::getArtistEvents(Application::$app->session->get('user'));
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));

        $this->setLayout('artistlayout');
        return $this->artistRender('artist_events', ['events' => $events, 'artist' => $artist]);
    }

    public function editEvent()
    {
        $event = EventsModel::editEvent();
        $artist = ArtistModel::getArtistProfile(Application::$app->session->get('user'));

        $this->setLayout('artistlayout');
        return $this->artistRender('edit_event', ['event' => $event, 'artist' => $artist]);
    }

    public function deleteEvent()
    {
        $delEvent = EventsModel::deleteEvent();

        return $this->artistRender('delete_event', ['delEvent' => $delEvent]);
    }
}
