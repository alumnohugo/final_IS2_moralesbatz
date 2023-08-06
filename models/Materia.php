<?php
namespace Model;

class Materia extends ActiveRecord{
    protected static $tabla = 'materias';
    protected static $columnasDB = ['materia_nombre','materia_situacion'];
    protected static $idTabla = 'materia_id';


    public $materia_id;
    public $materia_nombre;
    public $materia_situacion;
    
    public function __construct($args =[])
    {
        $this->materia_id = $args['materia_id'] ?? null;
        $this->materia_nombre = $args['materia_nombre'] ?? '';
        $this->materia_situacion = $args['materia_situacion'] ?? '1';
        
    }
}

?>