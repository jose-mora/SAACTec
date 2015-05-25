<?php
    class obj_resultadoProcAsignacion{      
      public $procesoAsignacion;
      public $sede;
      public $curso;
      public $ideGrupo;
      public $franja;
      public $profesor;
      
      // Assigning the values
      public function __construct($procesoAsignacion,$sede,$curso,$ideGrupo,$franja,$profesor) {
        $this->procesoAsignacion = $procesoAsignacion;
        $this->sede = $sede;
        $this->curso = $curso;
        $this->ideGrupo = $ideGrupo;
        $this->franja = $franja;
        $this->profesor = $profesor;
      }
    }
          
?>