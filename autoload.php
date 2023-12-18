<?php
spl_autoload_register(function ($class) { // esto carga automaticamente las classes
    $route = str_replace('\\', '/', $class) . '.php';
    if (file_exists($route)) {
        require_once $route;
    }else{
        echo 'No se encontro la clase ' . $class;
    }

});