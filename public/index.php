<?php
ini_set('upload_max_filesize','8M');

use app\controllers\AdminController;
use app\controllers\ArtistController;
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\models\User;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();



$config =[
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application( dirname(__DIR__), $config);


$app->router->get('/', [SiteController::class,'home']);
$app->router->get('/artists', [SiteController::class, 'artists']);
$app->router->get('/releases', [SiteController::class, 'releases']);
$app->router->get('/artist_detail', [SiteController::class, 'artistDetail']);
$app->router->get('/album', [SiteController::class, 'albumDetail']);




$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/signup', [AuthController::class, 'signup']);
$app->router->post('/signup', [AuthController::class, 'signup']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'editProfile']);
$app->router->post('/profile', [AuthController::class, 'editProfile']);



$app->router->get('/create_artist', [ArtistController::class, 'createArtist']);
$app->router->post('/create_artist', [ArtistController::class, 'createArtist']);
$app->router->get('/artist_profile', [ArtistController::class, 'artistProfile']);
$app->router->post('/artist_photo', [ArtistController::class, 'addPhoto']);
$app->router->get('/artist_photo', [ArtistController::class, 'addPhoto']);
$app->router->get('/artist_area', [ArtistController::class, 'artistArea']);
$app->router->get('/edit_artist', [ArtistController::class, 'editArtist']);
$app->router->post('/edit_artist', [ArtistController::class, 'editArtist']);
$app->router->get('/delete_artist_page', [ArtistController::class, 'deleteArtist']);



$app->router->post('/artist_albums', [ArtistController::class,'artist_albums']);
$app->router->get('/artist_albums', [ArtistController::class,'artist_albums']);
$app->router->get('/create_album', [ArtistController::class, 'createAlbum']);
$app->router->post('/create_album', [ArtistController::class, 'createAlbum']);
$app->router->get('/edit_album', [ArtistController::class, 'updateArtistAlbum']);
$app->router->post('/edit_album', [ArtistController::class, 'updateArtistAlbum']);
$app->router->get('/album_detail', [ArtistController::class, 'albumDetail']);
$app->router->post('/album_detail', [ArtistController::class, 'albumCover']);
$app->router->get('/delete_album', [ArtistController::class, 'deleteAlbum']);

$app->router->get('/add_track', [ArtistController::class, 'createTrack']);
$app->router->post('/add_track', [ArtistController::class, 'createTrack']);
$app->router->get('/delete_track', [ArtistController::class, 'deleteAlbumTrack']);

$app->router->get('/add_link', [ArtistController::class, 'createSocial']);
$app->router->post('/add_link', [ArtistController::class, 'createSocial']);
$app->router->get('/edit_link', [ArtistController::class, 'editSocial']);
$app->router->post('/edit_link', [ArtistController::class, 'editSocial']);
$app->router->get('/delete_link', [ArtistController::class, 'deleteSocial']);

$app->router->get('/add_event', [ArtistController::class, 'createEvent']);
$app->router->post('/add_event', [ArtistController::class, 'createEvent']);
$app->router->get('/edit_event', [ArtistController::class, 'editEvent']);
$app->router->post('/edit_event', [ArtistController::class, 'editEvent']);
$app->router->get('/delete_event', [ArtistController::class, 'deleteEvent']);
$app->router->get('/artist_events', [ArtistController::class, 'artistEvents']);

$app->router->get('/dashboard', [AdminController::class, 'admin']);
$app->router->get('/usersList', [AdminController::class, 'usersList']);
$app->router->get('/edit_user', [AdminController::class, 'editUser']);
$app->router->post('/edit_user', [AdminController::class, 'editUser']);
$app->router->get('/delete_user', [AdminController::class, 'deleteUser']);
$app->router->get('/artistsList', [AdminController::class, 'artistList']);
$app->router->get('/delete_artist', [AdminController::class, 'deleteArtist']);


$app->run();
