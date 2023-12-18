<?php
require_once __DIR__ . '/../config/app.php';
function ayuda() {
    echo "Uso: merp comando [argumentos]\n";
    echo "Comandos disponibles:\n";
    echo "  version\n";
    echo "  help - Muestra los comandos disponibles\n";
    echo "  crear-controlador <NOMBRE> - Genera un nuevo controlador.\n";
    echo "  crear-modelo <NOMBRE> - Genera un nuevo modelo.\n";
}
function version() {
    echo "   \e[0;33m keso framework PHP version \e[0;32m". APP_VERSION . "\e[0m\n";
    echo "   \e[0;33m merp-cli version \e[0;32m". APP_CLI_VERSION . "\e[0m\n";
}

function crearControlador($nombre) {
    $plantillaControlador = file_get_contents(__DIR__ . '/templates/controller.php');
    $contenidoControlador = str_replace('{NAME}', $nombre, $plantillaControlador);

    $archivoControlador = __DIR__ . '/../app/Controllers/' . $nombre . 'Controller.php';
    if(!file_exists($archivoControlador)){
        if (file_put_contents($archivoControlador, $contenidoControlador)) {
            echo "\e[0;32m El modelo ". $nombre . "Controller fue creado exitosamente. \e[0m\n";
        } else {
            echo "Error al crear el controlador\n";
            exit(1);
        }
    }else{
        echo "\e[0;31m El controlador ya existe. \e[0m\n";
        exit(1);
    }
}

function crearModelo($nombre) {
    $plantillaModelo = file_get_contents(__DIR__ . '/templates/model.php');
    $contenidoModelo = str_replace('{NAME}', $nombre, $plantillaModelo);

    $archivoModelo = __DIR__ . '/../app/Models/' . $nombre . 'Model.php';
    if(!file_exists($archivoModelo)) {

        if (file_put_contents($archivoModelo, $contenidoModelo)) {
            echo "\e[0;32m El modelo ". $nombre . "Model fue creado exitosamente. \e[0m\n";
        } else {
            echo "Error al crear el modelo\n";
            exit(1);
        }
    }else{
        echo "\e[0;31m El modelo ya existe. \e[0m\n";
        exit(1);
    }
}
