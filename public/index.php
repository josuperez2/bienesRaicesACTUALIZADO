<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\propiedadController;

$router = new Router();

$router->get('/public/index.php', [new propiedadController(), 'index']);
$router->get('/public/crear', [new propiedadController(), 'crear']);
$router->get('/public/actualizar', [new propiedadController(), 'actualizar']);

$router->comprobarRuta();
