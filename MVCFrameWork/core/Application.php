<?php

namespace app\core;
use app\core\Router;
use app\core\Response;

class Application
{
    public Request $request;
    public Router $router ;
    public static string $ROOT_DIR;
    public Response $response;
    public static Application $app;
    public controller $controller; 
    public function __construct($rootpath)
    {
        self::$ROOT_DIR= $rootpath;
        self::$app= $this;
        $this->controller=new Controller();
        $this->response = new Response();
        $this->request=new Request();
        $this->router =new Router($this->request , $this->response);   
    }

    public function run()
    {
       echo $this->router->resolve();
    }

    public function getController()
    {
        return $this->controller;
    }
    public function setController ($controller)
    {
        $this->controller= $controller;
    }
}