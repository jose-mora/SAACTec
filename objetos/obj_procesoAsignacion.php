<?php
    class obj_procesoAsignacion{
      public $nombre;
      public $activo;
      
      // Assigning the values
      public function __construct($nombre,$activo) {
        $this->nombre = $nombre;
        $this->activo = $activo;
      }
    }
          
?>