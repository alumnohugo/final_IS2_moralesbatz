<?php

namespace Controllers;
use Exception;
use Model\Arma;
use MVC\Router;

class ArmaController{
    public static function index(Router $router) {
        $armas = Arma::all();
        // var_dump($armas);
        // exit;
        $router->render('armas/index', [
            'armas' =>$armas
       ]);
// ================hasta aqui se puede ver la tabla sin ejecutarse acciones         
    
    }

    public static function guardarApi(){
     
        try {
            $arma = new Arma($_POST);
            $resultado = $arma->crear();

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
        // $armas = arma::all();
        $arma_nombre = $_GET['arma_nombre'];
       

        $sql = "SELECT * FROM armas where arma_situacion = 1 ";
        if ($arma_nombre != '') {
            $sql .= " and arma_nombre like '%$arma_nombre%' ";
        }
        
        
        try {
            
            $armas = Arma::fetchArray($sql);
            header('Content-Type: application/json');

            echo json_encode($armas);
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
            $arma = new Arma($_POST);
            // $resultado = $arma->crear();

            $resultado = $arma->actualizar();

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
            $arma_id = $_POST['arma_id'];
            $arma = Arma::find($arma_id);
            $arma->arma_situacion = 0;
            $resultado = $arma->actualizar();

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