<?php
/**we write here al the request routes
 and then you write the "run()" function that simply handle everthing
 **/
use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;
require_once __DIR__ .'/../vendor/autoload.php';


$app=new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', 'contact');
$app->router->post('/contact',[SiteController::class,'contact']);
$app->router->post('/contact',[SiteController::class,'handleContact']);
$app->router->get('/login',[AuthController::class , 'login']);
$app->router->post('/login',[AuthController::class , 'login']);
$app->router->get('/register',[AuthController::class , 'register']);
$app->router->post('/register',[AuthController::class , 'register']);

$app->run();
