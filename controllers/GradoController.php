<?php

namespace Controllers;
use Exception;
use Model\Grado;
use MVC\Router;

class GradoController{
    public static function index(Router $router) {
        $grados = Grado::all();
        // var_dump($grados);
        // exit;
        $router->render('grados/index', [
            'grados' =>$grados
       ]);
// ================hasta aqui se puede ver la tabla sin ejecutarse acciones         
    
    }

    public static function guardarApi(){
     
        try {
            $grado = new Grado($_POST);
            $resultado = $grado->crear();

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
        // $grados = grado::all();
   
        
        
        try {
            $grado_nombre = $_GET['grado_nombre'];
           
    
            $sql = "SELECT * FROM grados where grado_situacion = 1 ";
            if ($grado_nombre != '') {
                $sql .= " and grado_nombre like '%$grado_nombre%' ";
            }
            
            $resultado = Grado::fetchArray($sql);
            header('Content-Type: application/json');

         echo json_encode($resultado);

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
            $grado = new Grado($_POST);
            // $resultado = $grado->crear();

            $resultado = $grado->actualizar();

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
            $grado_id = $_POST['grado_id'];
            $grado = Grado::find($grado_id);
            $grado->grado_situacion = 0;
            $resultado = $grado->actualizar();

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