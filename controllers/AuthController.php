<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('authlogin');
        return $this->render('login');
    }

    public function signup(Request $request)
    {
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());


            if ($registerModel->validate() && $registerModel->register()) {
                return 'Party is on';
            }


            return $this->render('signup', [
                'model' => $registerModel
            ]);

        }
        $this->setLayout('authsignup');
        return $this->render('signup', [
            'model' => $registerModel
        ]);

    }
}