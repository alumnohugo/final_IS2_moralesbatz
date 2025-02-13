<?php

namespace Controllers;
use Exception;
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

    public static function guardarApi(){
     
        try {
            $materia = new Materia($_POST);
            $resultado = $materia->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

   
    public static function buscarApi()
    {
        // $materias = Materia::all();
        $materia_nombre = $_GET['materia_nombre'];
       

        $sql = "SELECT * FROM materias where materia_situacion = 1 ";
        if ($materia_nombre != '') {
            $sql .= " and materia_nombre like '%$materia_nombre%' ";
        }
        
        
        try {
            
            $materias = Materia::fetchArray($sql);
            header('Content-Type: application/json');

            echo json_encode($materias);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarApi(){
     
        try {
            $materia = new Materia($_POST);
            // $resultado = $materia->crear();

            $resultado = $materia->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function eliminarApi(){
     
        try {
            $materia_id = $_POST['materia_id'];
            $materia = Materia::find($materia_id);
            $materia->materia_situacion = 0;
            $resultado = $materia->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

}
 
?>