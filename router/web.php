<?php

use Lib\Route;
use App\Controllers\HomeController;
// IMPORTA EL ORDEN DE LAS SLUGS, PRIMERO DEFINIR LAS QUE NO TIENEN PARAMETROS Y LUEGO LAS QUE SI TIENEN PARAMETROS

Route::get('/', [HomeController::class, 'index']);

Route::get('/kesote/:slug', function($slug){
    return 'kesote ' . $slug;
});

Route::dispatch();