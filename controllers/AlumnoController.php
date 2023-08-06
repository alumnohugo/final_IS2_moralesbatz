<?php

namespace Controllers;
use Exception;
use Model\Alumno;
use MVC\Router;

class AlumnoController{
    public static function index(Router $router) {
        // se declara una variable para alamcenar
        $grados = static::grados();
        $armas = static::armas();
        $router->render('alumnos/index', [
            // se renderiza a la vista viejo pero mira
            'grados' => $grados, //buena onda 
            'armas' => $armas
       ]);
     
    
    }
      


    public static function guardarApi(){
    
     
        try {
            $alumno = new Alumno($_POST);
            $resultado = $alumno->crear();
            // echo json_encode($resultado);
            // exit;
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
        // $alumnos = alumno::all();
        $alumno_nombre = $_GET['alumno_nombre'];
       

        $sql = "SELECT
                    a.alumno_id,
                    a.alumno_nombre,
                    a.alumno_apellido,
                    g.grado_nombre AS alumno_grado,
                    arma.arma_nombre AS alumno_arma,
                    a.alumno_nacionalidad,
                    a.alumno_situacion
                FROM
                    alumnos a
                JOIN
                    grados g ON a.alumno_grado_id = g.grado_id
                JOIN
                    armas arma ON a.alumno_arma_id = arma.arma_id
                WHERE
                a.alumno_situacion = '1'";

        if ($alumno_nombre != '') {
            $sql .= " AND a.alumno_nombre LIKE '%$alumno_nombre%'";
        }

        
        try {
            
            $alumnos = Alumno::fetchArray($sql);
            header('Content-Type: application/json');

            echo json_encode($alumnos);
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
            $alumno = new Alumno($_POST);
            // $resultado = $alumno->crear();

            $resultado = $alumno->actualizar();

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
            $alumno_id = $_POST['alumno_id'];
            $alumno = Alumno::find($alumno_id);
            $alumno->alumno_situacion = 0;
            $resultado = $alumno->actualizar();

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

    
    
    
    // se crea una funcion statica que mande a traer todos los grados 
    public  static function grados()
    {
        
        
        $sql = "SELECT * FROM grados  ";
        
        
        
        try {
            
            $grados = Alumno::fetchArray($sql);
 
            if ($grados){
                
                return $grados; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
    


    public  static function armas()
    {
        
        
        $sql = "SELECT * FROM armas WHERE arma_situacion = 1";
        
        
        
        try {
            
            $armas = Alumno::fetchArray($sql);
 
            if ($armas){
                
                return $armas; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
    
}
