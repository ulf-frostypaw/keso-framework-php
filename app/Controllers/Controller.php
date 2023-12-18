<?php

namespace App\Controllers;

class Controller
{
    public function view($route, $data = []){ // $data = [] es un array vacio
        // desestructuramos el array
        extract($data);
        
        $route = str_replace('.', '/', $route);
        if(file_exists('resources/views/' . $route . '.view.php')){
            ob_start(); // Inicia el almacenamiento en el buffer
            include 'resources/views/' . $route . '.view.php';
            $view = ob_get_clean();
            return $view;

        }else{
            echo 'No se encontro la vista ' . $route;
        }
    }
}