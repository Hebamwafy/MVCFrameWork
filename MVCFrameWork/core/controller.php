<?php
namespace app\core;
use app\core\Application;
class controller
{
    public string $layout= 'main';
    public function setlayout($layout)
{
   $this ->layout = $layout;
}
public function render($views , $params=[])
{
  return Application::$app->router->renderview($views , $params);
}

}