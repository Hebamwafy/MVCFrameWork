<?php
namespace app\core;
class Router{

    public Request $request;
    
    public controller $controller;
    public Response $response;
    protected array $routes=[];

    public function __construct(Request $request, Response $response)
    {
        $this->request=$request;
        $this->response=$response;
    }
    public function get($path , $callback)
    {
        $this->routes['get'][$path]=$callback; 
    }

    public function post($path , $callback)
    {
        $this->routes['post'][$path]=$callback;
    }
    
    public function resolve()
    {
        $path=$this->request->getPath();
        $method=$this->request->method();
        $callback=$this->routes[$method][$path]?? false;
        if($callback===false)
        {
           $this->response->setStatusCode(404);
           return $this->renderview("_404");
        }
        if(is_string($callback))
        {
            return $this->renderview($callback);
        }
        if(is_array($callback))
        {
           Application::$app->controller=new $callback[0]();
           $callback[0]=Application::$app->controller;
        }
       
       return call_user_func($callback,$this->request);
     

    }
    protected function layoutContent()
    {
        $layout=Application::$app->controller->layout;
        ob_start();
        require_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }
    public function renderview($view,$params=[])
    { 
       $layoutContent=$this->layoutContent();
       $viewContent= $this->renderOnlyView($view,$params);
       return str_replace('{{content}}', $viewContent ,$layoutContent);
    }
    
    public function renderContent($viewContent)
    { 
       $layoutContent=$this->layoutContent();
       return str_replace('{{content}}', $viewContent ,$layoutContent);
    }

     protected function renderOnlyView($view,$params)
     { 
        foreach($params as $key =>$value)
        {
            $$key= $value;
        }
        ob_start();
        require_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
     }



}