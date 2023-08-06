<?php 
require_once __DIR__ . '/../includes/app.php';


use Controllers\MateriaController;
use Controllers\GradoController;
use MVC\Router;
use Controllers\AppController;
$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/materias', [MateriaController::class,'index']);
$router->get('/API/materias/buscar', [MateriaController::class,'buscarApi']);
$router->post('/API/materias/guardar', [MateriaController::class,'guardarApi']);
$router->post('/API/materias/modificar', [MateriaController::class,'modificarApi']);
$router->post('/API/materias/eliminar', [MateriaController::class,'eliminarApi']);

$router->get('/grados', [GradoController::class,'index']);
$router->get('/API/grados/buscar', [GradoController::class,'buscarApi']);
$router->post('/API/grados/guardar', [GradoController::class,'guardarApi']);
$router->post('/API/grados/modificar', [GradoController::class,'modificarApi']);
$router->post('/API/grados/eliminar', [GradoController::class,'eliminarApi']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
