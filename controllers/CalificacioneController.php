<?php

namespace Controllers;
use Exception;
use Model\Calificacion;
use MVC\Router;

class CalificacionController{
    public static function index(Router $router) {
        // se declara una variable para alamcenar
        $calificaciones = static::alumnos();
     
        $router->render('calificaciones/index', [
           
            'calificaciones' => $calificaciones
            
       ]);
     
    
    }



    public static function guardarApi(){
    
     
        try {
            $calificacion = new Calificacion($_POST);
            $resultado = $calificacion->crear();
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
        // $Calificaciones = Calificacion::all();
        $alumno_nombre = $_GET['asig_alumno'];
       
        $sql = "SELECT
        a.asig_id,
        TRIM(alumno.alumno_nombre) || ' ' || TRIM(alumno.alumno_apellido) AS alumno_nombre,
        TRIM(materia.materia_nombre) AS materia_asignada,
        a.asig_situacion
    FROM
        Calificaciones a
    JOIN
        alumnos alumno ON a.asig_alumno = alumno.alumno_id
    JOIN
        materias materia ON a.asig_materia = materia.materia_id
    WHERE
        a.asig_situacion = '1'";

    if ($alumno_nombre != '') {
        $sql .= " AND (TRIM(alumno.alumno_nombre) || ' ' || TRIM(alumno.alumno_apellido)) LIKE '%$alumno_nombre%'";
    }



        
        try {
            
            $Calificacion = Calificacion::fetchArray($sql);
            header('Content-Type: application/json');

            echo json_encode($Calificacion);
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
            $Calificacion = new Calificacion($_POST);
            // $resultado = $Calificacion->crear();
            
            $resultado = $Calificacion->actualizar();
            
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
            $Calificacion_id = $_POST['asig_id'];
            $Calificacion = Calificacion::find($Calificacion_id);
            $Calificacion->asig_situacion = 0;
            $resultado = $Calificacion->actualizar();

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
    public  static function alumnos()
    {
        
        
        $sql = "SELECT * FROM alumnos WHERE alumno_situacion = 1 ";
        
        
        
        try {
            
            $alumnos = Calificacion::fetchArray($sql);
 
            if ($alumnos){
                
                return $alumnos; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
    


    public  static function materias()
    {
        
        
        $sql = "SELECT * FROM materias WHERE materia_situacion = 1";
        
        
        
        try {
            
            $materias = Calificacion::fetchArray($sql);
 
            if ($materias){
                
                return $materias; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
    
}
