<?php

namespace Controllers;
use Model\Materia;
use MVC\Router;

class MateriaController{
    public static function index(Router $router) {
        $materias = Materia::all();
        // var_dump($materias);
        // exit;
        $router->render('materias/index', [
            'materias' =>$materias
       ]);
// ================hasta aqui se puede ver la tabla sin ejecutarse acciones         
    


    }
}
?>