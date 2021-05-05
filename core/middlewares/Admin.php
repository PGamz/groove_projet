<?php


namespace app\core\middlewares;


use app\core\Application;
use app\core\exception\AdminException;


class Admin extends BaseMiddleware

{

    public array $actions = [];

    /**
     * AuthMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;

    }

    /**
     *
     * @throws AdminException
     */
    public function execute()
    {
        if(Application::isAdmin())  {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new AdminException();

            }
        }

    }

}

{

}