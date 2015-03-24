<?php

	class obj_grupo {
            // Creating some properties (variables tied to an object)
            public $ideGrupo;
            public $curso;
            public $sede;
            public $franja;
            public $activo;
            
            // Assigning the values
            public function __construct($ideGrupo, $curso, $sede,$franja,$activo) {
              $this->ideGrupo = $ideGrupo;
              $this->curso = $curso;
              $this->sede = $sede;
              $this->franja = $franja;
              $this->activo = $activo;
            }
    }
          
?>