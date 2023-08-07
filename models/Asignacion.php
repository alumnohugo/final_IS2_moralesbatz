<?php
namespace Model;

class  Asignacion extends ActiveRecord{
    protected static $tabla = 'asignaciones';
    protected static $columnasDB = ['asig_alumno','asig_materia','asig_situacion'];
    protected static $idTabla = 'asig_id';


    public $asig_id;
    public $asig_alumno;
    public $asig_materia;
    public $asig_situacion;
    
    public function __construct($args =[])
    {
        $this->asig_id = $args['asig_id'] ?? null;
        $this->asig_alumno = $args['asig_alumno'] ?? '';
        $this->asig_materia = $args['asig_materia'] ?? '';
        $this->asig_situacion = $args['asig_situacion'] ?? '1';
        
        
    }
}

?>