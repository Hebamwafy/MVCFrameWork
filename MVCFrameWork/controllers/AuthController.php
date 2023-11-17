<?php
namespace app\controllers;
use app\core\controller;
use app\core;
use app\core\Request;
use app\models\RegisterModel;
class AuthController extends controller
{
    public function login()
    {
        $this->setlayout('auth');
        return $this->render('login');
    }
    public function register(Request $request)
    {
        $registerModel=new RegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate()&& $registerModel->register()) {
                return "Success";
            }
            return $this->render('register',[
                'model'=>$registerModel
            ]); 
        }
        $this->setlayout('auth');
        return $this->render('register',[
            'model'=>$registerModel
        ]); 
    }

}