<?php

class obj_sede {

    // Creating some properties (variables tied to an object)
    public $name;
    public $ide;
    public $activo;
    public $creadoPor;
    public $modificadoPor;
    public $fechaCreacion;
    public $fechaModificacion;

    // Assigning the values
    public function __construct($ide, $name, $activo/*, $creadoPor, $modificadoPor, $fechaCreacion, $fechaModificacion*/) {
        $this->ide = $ide;
        $this->name = $name;
        $this->activo = $activo;
        /*$this->creadoPor = $creadoPor;
        $this->modificadoPor = $modificadoPor;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaModificacion = $fechaModificacion;*/
    }

}

?>