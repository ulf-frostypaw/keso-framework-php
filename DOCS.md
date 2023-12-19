# Documentación de Keso Framework PHP

## Índice

- [Documentación de Keso Framework PHP](#documentación-de-keso-framework-php)
  - [Índice](#índice)
  - [Introducción](#introducción)
  - [Instalación](#instalación)
    - [Configuración inicial](#configuración-inicial)
  - [Enrutamiento](#enrutamiento)
  - [Controladores](#controladores)
  - [Vistas](#vistas)
  - [Base de datos](#base-de-datos)
    - [Funciones disponibles](#funciones-disponibles)
  - [merp-cli](#merp-cli)

## Introducción

Keso Framework PHP es un marco de desarrollo web rápido y ligero para PHP. Basado en la arquitectura MVC (model, view, controller).

## Instalación

Para instalar Keso Framework PHP descarga o clona este repositorio en tu directorio de tu servidor.

### Configuración inicial

Accede al archivo ```/config/app.php``` para modificar las constantes del proyecto.

* Constantes disponibles:
  * APP_NAME - Nombre por defecto del proyecto (opcional)
  * APP_URL - URL principal (opcional)
  * APP_TIMEZONE - Zona horaria
  * APP_PUBLIC - Ubicacion de la carpeta pública
  * APP_VIEWS - Ubicacion por defecto de la carpeta de views

## Enrutamiento

Explicación de cómo funciona el enrutamiento en Keso Framework PHP.

## Controladores

Información sobre cómo crear y usar controladores en Keso Framework PHP.

Puedes generar un controlador usando la linea de comandos ```merp crear-controlador <nombreController>```.
## Vistas

La carpeta de vistas está separada. Ubicada en ```/resources/views/``` donde se incluyen todas las vistas.

## Base de datos
El archivo ```/config/database.php``` que son las constantes para la conexión a la base de datos. Por defecto se usa MySQL.

Keso Framework PHP esta pensado para aplicaciones sencillas y escalables. Se emplean funciones de un CRUD para realizar peticiones a la base de datos.

**Nota:** Por seguridad, se preparan todas las consultas antes de ser ejecutas en la base de datos.

### Funciones disponibles
* ```first()``` - retorna el primer resultado disponible
* ```getAll()``` -
* ```findById($id)``` - Por defecto espera una consulta a la columna **```id```**
* ```findBy($column, $value)``` -
* ```create($columns, $data)``` - 
* ```update($id, $data)``` -
* ```delete($id)``` -


## merp-cli
Linea de comandos internas con funciones basicas para ahorrar tiempo al momento de generar controladores y modelos.
Ejecuta el comando ```php merp``` para ver la lista de comandos disponibles.