<?php

namespace app\core;

class View
{
    public string $title = '';

    public function renderArtistView($view, $params = [])
    {
        $viewContent = $this->renderArtistOnlyView($view, $params);
        $adminLayoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $adminLayoutContent);
    }

    protected function renderArtistOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/partials/artist/$view.phtml";
        return ob_get_clean();
    }

    public function renderAdminView($view, $params = [])
    {
        $viewContent = $this->renderAdminOnlyView($view, $params);
        $adminLayoutContent = $this->adminLayoutContent();
        return str_replace('{{content}}', $viewContent, $adminLayoutContent);
    }

    protected function renderAdminOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/partials/admin/$view.phtml";
        return ob_get_clean();
    }
    protected function adminLayoutContent()
    {
        $adminLayout = Application::$app->adminLayout;
        if (Application::$app->controller) {
            $adminLayout = Application::$app->controller->adminLayout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/admin/$adminLayout.phtml";
        return ob_get_clean();
    }

    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.phtml";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/partials/public/$view.phtml";
        return ob_get_clean();
    }

    public function renderUserView($view, $params = [])
    {
        $viewContent = $this->renderUserOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function renderUserOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/partials/user/$view.phtml";
        return ob_get_clean();
    }
}
