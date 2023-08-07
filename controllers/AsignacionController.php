<?php

namespace Controllers;
use Exception;
use Model\Asignacion;
use MVC\Router;

class AsignacionController{
    public static function index(Router $router) {
        // se declara una variable para alamcenar
        $alumnos = static::alumnos();
        $materias = static::materias();
        $router->render('asignaciones/index', [
           
            'alumnos' => $alumnos, 
            'materias' => $materias
       ]);
     
    
    }



    public static function guardarApi(){
    
     
        try {
            $asignacion = new Asignacion($_POST);
            $resultado = $asignacion->crear();
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
        // $asignaciones = Asignacion::all();
        $asig_alumno = $_GET['asig_alumno'];

        // $asig_materia = $_GET['asig_materia'];
       
        $sql = "SELECT
        a.asig_id,
        TRIM(alumno.alumno_nombre) || ' ' || TRIM(alumno.alumno_apellido) AS alumno_nombre,
        TRIM(materia.materia_nombre) AS materia_nombre,
        a.asig_situacion
    FROM
        asignaciones a
    JOIN
        alumnos alumno ON a.asig_alumno = alumno.alumno_id
    JOIN
        materias materia ON a.asig_materia = materia.materia_id
    WHERE
        a.asig_situacion = '1'";

    if ($asig_alumno != '') {
        $sql .= " AND (TRIM(alumno.alumno_nombre) || ' ' || TRIM(alumno.alumno_apellido)) LIKE '%$asig_alumno%'";
    }

    



        
        try {
            
            $asignacion = Asignacion::fetchArray($sql);
            header('Content-Type: application/json');

            echo json_encode($asignacion);
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
            $asignacion = new Asignacion($_POST);
            // $resultado = $Asignacion->crear();
            
            $resultado = $asignacion->actualizar();
            
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
            $asignacion_id = $_POST['asig_id'];
            $asignacion = Asignacion::find($asignacion_id);
            $asignacion->asig_situacion = 0;
            $resultado = $asignacion->actualizar();

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
            
            $alumnos = Asignacion::fetchArray($sql);
 
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
            
            $materias = Asignacion::fetchArray($sql);
 
            if ($materias){
                
                return $materias; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
    
}
