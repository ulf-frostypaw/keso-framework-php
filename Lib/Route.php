<?php
namespace Lib;

class Route{
    private static $routes = [];

    public static function get($route, $callback){
        $route = trim($route, '/');
        self::$routes['GET'][$route] = $callback;
    }
    public static function post($route, $callback){
        $route = trim($route, '/');
        self::$routes['POST'][$route] = $callback;
    }
    public static function dispatch(){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];
        foreach(self::$routes[$method] as $route => $callback ){
            
            if(strpos($route, ':') !== false){
                $route = preg_replace('#:[a-zA-Z0-9]+#', '([a-zA-Z0-9]+)', $route);
            }

            // Reemplaza los parámetros de la ruta con una expresión regular
            $route = preg_replace('/:([a-z]+)/', '([a-z-]+)', $route);
            if (preg_match("#^$route$#", $uri, $matches)) {
                $params = array_slice($matches, 1);

                // comprueba si es una función o un controlador
                if(is_callable($callback)){
                    $response = $callback(...$params);
                }
                if(is_array($callback)){
                    $controller = new $callback[0];        // pasa los parametros a la funcion
                    $response = $controller->{$callback[1]}(...$params);
                }


                if(is_array($response) || is_object($response)){
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    return;
                }else{
                    echo $response;
                }
                return;
            }
        }
        echo '404';
    }
}