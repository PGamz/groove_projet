<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                if (Application::$app->user->Admin == 3) {
                    $response->redirect('/dashboard');
                } elseif (Application::$app->user->Admin == 2) {
                    $response->redirect('/artist_area');
                } else {
                    $response->redirect('/profile');
                    return '';
                }
            }
        }

        $this->setLayout('authlogin');

        return $this->render('login', ['model' => $loginForm]);
    }

    public function signup(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Party is on');
                Application::$app->response->redirect('/login');
            }

            return $this->render('signup', ['model' => $user]);
        }
        $this->setLayout('authsignup');
        return $this->render('signup', ['model' => $user]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/login');
    }

    public function editProfile()
    {
        $user = Application::$app->user->editProfile();

        return $this->userRender('profile', ['item' => $user]);
    }
}
