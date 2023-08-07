<?php 
require_once __DIR__ . '/../includes/app.php';


use Controllers\MateriaController;
use Controllers\GradoController;
use Controllers\ArmaController;
use Controllers\AlumnoController;
use Controllers\AsignacionController;
use Controllers\CalificacionController;
use Controllers\DetalleController;
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

$router->get('/armas', [ArmaController::class,'index']);
$router->get('/API/armas/buscar', [ArmaController::class,'buscarApi']);
$router->post('/API/armas/guardar', [ArmaController::class,'guardarApi']);
$router->post('/API/armas/modificar', [ArmaController::class,'modificarApi']);
$router->post('/API/armas/eliminar', [ArmaController::class,'eliminarApi']);

$router->get('/alumnos', [AlumnoController::class,'index']);
$router->get('/API/alumnos/buscar', [AlumnoController::class,'buscarApi']);
$router->post('/API/alumnos/guardar', [AlumnoController::class,'guardarApi']);
$router->post('/API/alumnos/modificar', [AlumnoController::class,'modificarApi']);
$router->post('/API/alumnos/eliminar', [AlumnoController::class,'eliminarApi']);

$router->get('/asignaciones', [AsignacionController::class,'index']);
$router->get('/API/asignaciones/buscar', [AsignacionController::class,'buscarApi']);
$router->post('/API/asignaciones/guardar', [AsignacionController::class,'guardarApi']);
$router->post('/API/asignaciones/modificar', [AsignacionController::class,'modificarApi']);
$router->post('/API/asignaciones/eliminar', [AsignacionController::class,'eliminarApi']);

$router->get('/calificaciones', [CalificacionController::class,'index']);
$router->get('/API/calificaciones/buscar', [CalificacionController::class,'buscarApi']);
$router->post('/API/calificaciones/guardar', [CalificacionController::class,'guardarApi']);
$router->post('/API/calificaciones/modificar', [CalificacionController::class,'modificarApi']);
$router->post('/API/calificaciones/eliminar', [CalificacionController::class,'eliminarApi']);

$router->get('/detalles', [DetalleController::class,'index']);
$router->get('/API/detalles/buscar', [DetalleController::class,'buscarApi']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
