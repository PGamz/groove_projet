<?php


namespace app\core\middlewares;



use app\core\Application;
use app\core\exception\ArtistException;
use app\core\exception\ArtistProfileException;


class ArtistMiddleware extends BaseMiddleware

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
     * @throws \app\core\exception\ArtistException
     * @throws ArtistProfileException
     */
    public function execute()
    {
        if(Application::isArtist()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ArtistException();

            }else if (Application ::isArtist()) {
                {
                    if (empty($this -> actions) || in_array(Application ::$app -> controller -> action, $this -> actions)) {
                        throw new ArtistProfileException();
                    }
                }

            }
        }

    }

}
