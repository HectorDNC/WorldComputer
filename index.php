<?php
require_once 'system/Core/Config.php';
require_once 'vendor/autoload.php';

$router = new \System\Core\Router();
$view = new \System\Core\View();

$whiteList = [
    'usuario'
];

if(!isset($_SESSION)) {
    session_start();
}

// $_SESSION['isAuth'] = false;

// session_destroy();

// var_dump($_SESSION);


if(!empty($_SESSION['usuario'])) {
    
    if( $router->getController() == 'api' ){
        $controller = "App\\Api\\" . $router->getController();
        $method = $router->getMethod();
        $param = $router->getParam();
    
        $controller = new $controller();
        $controller->$method($param);
    
    }else{
        $controller = "App\\Controllers\\" . $router->getController() . "Controller";
        $file = "app/Controllers/" . $router->getController() . "Controller.php";
        if(file_exists($file)){
            $method = $router->getMethod();
            $param = $router->getParam();
            
            $controller = new $controller();
            if(method_exists($controller, $method)){
                $controller->$method($param);
            }
            else{
                $view->getView("Error.index");
            }
            
        }
        else{
            $view->getView("Error.index");
        }   
    }
    
} else {
    
    $controller = "App\\Controllers\\LoginController";
    $method = $router->getMethod();
    $param = $router->getParam();
    
    $controller = new $controller();
    $controller->$method($param);
}




