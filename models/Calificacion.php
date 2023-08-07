<?php
namespace Model;

class Calificacion extends ActiveRecord{
    protected static $tabla = 'calificaciones';
    protected static $columnasDB = ['calificacion_asignacion','calificacion_punteo','calificacion_resultado','calificacion_situacion'];
    protected static $idTabla = 'calificacion_id';


    public $calificacion_id;
    public $calificacion_asignacion;
    public $calificacion_punteo;
    public $calificacion_resultado;
    public $calificacion_situacion;
    
    public function __construct($args =[])
    {
        $this->calificacion_id = $args['calificacion_id'] ?? null;
        $this->calificacion_asignacion = $args['calificacion_asignacion'] ?? '';
        $this->calificacion_punteo = $args['calificacion_punteo'] ?? '';
        $this->calificacion_resultado = $args['calificacion_resultado'] ?? '';
        $this->calificacion_situacion = $args['calificacion_situacion'] ?? '1';
        
    }
}

?>