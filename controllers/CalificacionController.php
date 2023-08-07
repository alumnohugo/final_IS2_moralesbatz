<?php

namespace Controllers;
use Exception;
use Model\Calificacion;
use MVC\Router;

class CalificacionController{
    public static function index(Router $router) {
        // se declara una variable para alamcenar
        $asignaciones = static::asignaciones();
     
        $router->render('calificaciones/index', [
           
            'asignaciones' => $asignaciones
            
       ]);
     
    
    }



    public static function guardarApi(){
    
     
        try {
            $asignacion = new Calificacion($_POST);
            // echo json_encode($_POST);
            // exit;

            $resultado = $asignacion->crear();
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
        // $calificacion_asignacion = Calificacion::all();
      
        $calificacion_asignacion = $_GET['calificacion_id'];
     
        $sql = "SELECT
                a.calificacion_id,
                TRIM(alumno.alumno_nombre) || ' ' || TRIM(alumno.alumno_apellido) AS alumno_nombre,
                TRIM(materia.materia_nombre) AS materia_asignada,
                a.calificacion_punteo,
                a.calificacion_resultado,
                a.calificacion_situacion
            FROM
                calificaciones a
            JOIN
                alumnos alumno ON a.calificacion_asignacion = alumno.alumno_id
            JOIN
                materias materia ON a.calificacion_asignacion = materia.materia_id
            WHERE
                a.calificacion_situacion = '1'";
        
        if ($calificacion_asignacion != '') {
            $sql .= " AND a.calificacion_asignacion = '$calificacion_asignacion'";
        }
                     
        try {
            
            $calificacion = Calificacion::fetchArray($sql);
            echo json_encode($calificacion);
            exit;
            header('Content-Type: application/json');

            echo json_encode($calificacion);
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
            $calificacion = new Calificacion($_POST);
            // $resultado = $Calificacion->crear();
            
            $resultado = $calificacion->actualizar();
            
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
            $calificacion_id = $_POST['calificaion_id'];
            $calificacion = Calificacion::find($calificacion_id);
            $calificacion->calificacion_situacion = 0;
            $resultado = $calificacion->actualizar();

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
    public  static function asignaciones()
    {
        
        
        $sql = "SELECT
        a.asig_id,
        TRIM(alumno.alumno_nombre) || ' ' || TRIM(alumno.alumno_apellido) AS alumno_nombre,
        TRIM(materia.materia_nombre) AS materia_asignada,
        a.asig_situacion
    FROM
        asignaciones a
    JOIN
        alumnos alumno ON a.asig_alumno = alumno.alumno_id
    JOIN
        materias materia ON a.asig_materia = materia.materia_id
    WHERE
        a.asig_situacion = '1';
     ";
        
        
        
        try {
            
            $asignaciones = Calificacion::fetchArray($sql);
            // var_dump($asignaciones);
            // exit;
 
            if ($asignaciones){
                
                return $asignaciones; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }   


  
}
