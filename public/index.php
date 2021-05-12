<?php

use app\controllers\AdminController;
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
$app->router->get('/albums', [SiteController::class, 'albums']);



$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/signup', [AuthController::class, 'signup']);
$app->router->post('/signup', [AuthController::class, 'signup']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->post('/profile', [AuthController::class, 'profile']);
$app->router->get('/live', [AuthController::class, 'live']);
$app->router->get('/create_artist', [AuthController::class, 'createArtist']);
$app->router->post('/create_artist', [AuthController::class, 'createArtist']);
$app->router->get('/artist_profile', [AuthController::class, 'artistProfile']);


$app->router->get('/dashboard', [AdminController::class, 'admin']);
$app->router->get('/usersList', [AdminController::class, 'usersList']);

$app->router->get('/edit_user', [AdminController::class, 'editUser']);
$app->router->post('/edit_user', [AdminController::class, 'editUser']);
$app->router->get('/delete_user', [AdminController::class, 'deleteUser']);


$app->router->get('/artistsList', [AdminController::class, 'artistList']);
$app->router->get('/delete_artist', [AdminController::class, 'deleteArtist']);



$app->run();
