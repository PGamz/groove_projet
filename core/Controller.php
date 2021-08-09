<?php


namespace app\core;
use app\core\middlewares\BaseMiddleware;

/**
 * Class Controller
 * @package app\core
 */

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    public string $adminLayout = 'dashboard';

    protected $model;
    /**
     * @var BaseMiddleware[]
     */

    protected array $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;

    }


    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function adminRender($view, $params = [])
    {
        return Application::$app->view->renderAdminView($view, $params);
    }

    public function userRender($view, $params = [])
    {
        return Application::$app->view->renderUserView($view, $params);
    }


    public function artistRender($view, $params = [])
    {
        return Application::$app->view->renderArtistView($view, $params);
    }


    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {

        return $this->middlewares;

    }
}