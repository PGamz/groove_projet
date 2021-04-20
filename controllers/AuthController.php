<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
        $this->registerMiddleware(new AuthMiddleware(['live']));


    }
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/profile');
                return '';
            }

        }
        $this->setLayout('authlogin');

        return $this->render('login', [
            'model' => $loginForm

        ]);


    }

    public function signup(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());


            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success','Party is on');
                Application::$app->response->redirect('/login');


            }


            return $this->render('signup', [
                'model' => $user
            ]);

        }
        $this->setLayout('authsignup');
        return $this->render('signup', [
            'model' => $user
        ]);

    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/login');
    }

    public function profile()
    {

        return $this->render('profile');
    }

    public function live()
    {
        $this->setLayout('authlive');

        return $this->render('live');

    }



}