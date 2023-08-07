<?php

namespace Controllers;
use Exception;
use Model\Calificacion;
use MVC\Router;

class DetalleController{
    public static function index(Router $router) {
        // se declara una variable para alamcenar
        $calificaciones = static::calificaciones();
     
        $router->render('detalles/index', [
           
            'calificaciones' => $calificaciones
            
       ]);
     
    
    }
    public static function buscarApi()
    {

   
        
        $id = $_GET['id'];

    
        try {
            
                    $sql = " SELECT DISTINCT
                    alumno_id,
                        TRIM(alumno.alumno_nombre) || ' ' || TRIM(alumno.alumno_apellido) AS alumno_nombre,
                        TRIM(materia.materia_nombre) AS materia_asignada,
                        c.calificacion_punteo,
                        c.calificacion_resultado,
                        c.calificacion_situacion,
                        TRIM(grado.grado_nombre) || ' de ' || TRIM(arma.arma_nombre) AS grado_y_arma,
                        TRIM(alumno.alumno_nacionalidad) AS nacionalidad
                    FROM
                        calificaciones c
                    JOIN
                        asignaciones a ON c.calificacion_asignacion = a.asig_id
                    JOIN
                        alumnos alumno ON a.asig_alumno = alumno.alumno_id
                    JOIN
                        materias materia ON a.asig_materia = materia.materia_id
                    JOIN
                        grados grado ON alumno.alumno_grado_id = grado.grado_id
                    JOIN
                        armas arma ON alumno.alumno_arma_id = arma.arma_id
                    WHERE
                        c.calificacion_situacion = '1' and  alumno_id = $id";
          
            $calificaciones = Calificacion::fetchArray($sql);
    
            echo json_encode($calificaciones);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    

 

    
    
    
    // se crea una funcion statica que mande a traer todo
    public  static function calificaciones()
    {
     
        $sql = "SELECT DISTINCT alumno_id,
        TRIM(alumno.alumno_nombre) || ' ' || TRIM(alumno.alumno_apellido) AS alumno_nombre
    FROM
        calificaciones c
    JOIN
        asignaciones a ON c.calificacion_asignacion = a.asig_id
    JOIN
        alumnos alumno ON a.asig_alumno = alumno.alumno_id
    JOIN
        materias materia ON a.asig_materia = materia.materia_id
    WHERE
        c.calificacion_situacion = '1' ";
        
              
    
                     
        try {
            
            $calificaciones = Calificacion::fetchArray($sql);
            // var_dump($asignaciones);
            // exit;
 
            if ($calificaciones){
                
                return $calificaciones; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }  


  
}
