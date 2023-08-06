<?php
namespace Model;

class  Alumno extends ActiveRecord{
    protected static $tabla = 'alumnos';
    protected static $columnasDB = ['alumno_nombre','alumno_apellido','alumno_grado_id','alumno_arma_id','alumno_nacionalidad','alumno_situacion'];
    protected static $idTabla = 'alumno_id';


    public $alumno_id;
    public $alumno_nombre;
    public $alumno_apellido;
    public $alumno_grado_id;
    public $alumno_arma_id;
    public $alumno_nacionalidad;

    public $alumno_situacion;
    
    public function __construct($args =[])
    {
        $this->alumno_id = $args['alumno_id'] ?? null;
        $this->alumno_nombre = $args['alumno_nombre'] ?? '';
        $this->alumno_apellido = $args['alumno_apellido'] ?? '';
        $this->alumno_grado_id = $args['alumno_grado_id'] ?? '';
        $this->alumno_arma_id = $args['alumno_arma_id'] ?? '';
        $this->alumno_nacionalidad = $args['alumno_nacionalidad'] ?? '';
        $this->alumno_situacion = $args['alumno_situacion'] ?? '1';
        
        
    }
}

?>