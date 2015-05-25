<?php
    class obj_procesoAsignacion{
      public $idProcesoAsignacion;
      public $nombre;
      public $activo;
      public $ejecutado;
      
      // Assigning the values
      public function __construct($idProcesoAsignacion,$nombre,$activo,$ejecutado) {
        $this->idProcesoAsignacion = $idProcesoAsignacion;
        $this->nombre = $nombre;
        $this->activo = $activo;
        $this->ejecutado = $ejecutado;
      }
    }
          
?>