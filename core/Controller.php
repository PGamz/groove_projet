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
     * @var \app\core\middlewares\BaseMiddleware[]
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

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return \app\core\middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}