<?php

namespace app\core;
use app\core\db\Database;

/**
 * Class Application
 * @package app\core
 */

class Application
{
    public static string $ROOT_DIR;

    public string $layout = 'main';
    public string $adminLayout = 'dashboard';
    public string $userClass;

    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?UserModel $user;
    public View $view;

    public static Application $app;
    public ?Controller $controller = null;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];

        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();

        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();

            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    public static function isUser(): bool
    {
        if (self::$app->user === null || self::$app->user->Admin === 2 || self::$app->user->Admin === 3) {
            return true;
        }

        return false;
    }

    public static function isArtist(): bool
    {
        if (self::$app->user === null || self::$app->user->Admin === 1 || self::$app->user->Admin === 3) {
            return true;
        }

        return false;
    }

    public static function isAdmin(): bool
    {
        if (self::$app->user === null || self::$app->user->Admin === 1 || self::$app->user->Admin === 2) {
            return true;
        }

        return false;
    }

 public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }


    /**
     * @return \app\core\Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param \app\core\Controller $controller
     */
    public function setController(\app\core\Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user): bool
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->$primaryKey;
        $this->session->set('user', $primaryValue);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
