<?php

namespace App;

use App\controllers\IndexController;

class Route
{
    private $routes;
    private $requestedRoute;

    public function __construct()
    {
        $this->initRoutes();
        $this->setRequestedRoute();
        $this->runRoute();
    }

    public function initRoutes()
    {
        $this->routes['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        );

        $this->routes['explorar'] = array(
            'route' => '/explorar',
            'controller' => 'IndexController',
            'action' => 'explorar'
        );
        $this->routes['ingressos'] = array(
            'route' => '/ingressos',
            'controller' => 'IndexController',
            'action' => 'ingressos'
        );
        $this->routes['login'] = array(
            'route' => '/login',
            'controller' => 'IndexController',
            'action' => 'login'
        );
        $this->routes['create'] = array(
            'route' => '/create',
            'controller' => 'IndexController',
            'action' => 'create'
        );
    }

    public function setRequestedRoute()
    {
        $this->requestedRoute = $this->getUrl();
    }

    public function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function runRoute()
    {
        foreach ($this->routes as $routeName => $route) {
            if ($route['route'] == $this->requestedRoute) {
                $controllerName = 'App\controllers\\' . $route['controller'];
                $actionName = $route['action'];

                $controller = new $controllerName();
                $controller->$actionName();

                break; // Para a execução após encontrar a rota correspondente
            }
        }
    }
    
}
