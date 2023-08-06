<?php
namespace Model;

class  Arma extends ActiveRecord{
    protected static $tabla = 'armas';
    protected static $columnasDB = ['arma_nombre','arma_situacion'];
    protected static $idTabla = 'arma_id';


    public $arma_id;
    public $arma_nombre;
    public $arma_situacion;
    
    public function __construct($args =[])
    {
        $this->arma_id = $args['arma_id'] ?? null;
        $this->arma_nombre = $args['arma_nombre'] ?? '';
        $this->arma_situacion = $args['arma_situacion'] ?? '1';
        
    }
}

?>