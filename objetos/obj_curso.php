<?php

	class obj_curso {
            // Creating some properties (variables tied to an object)
            public $name;
            public $activo;
            public $ide;
            public $nivel;

            // Assigning the values
            public function __construct($ide,$name,$activo,$nivel) {
              $this->ide = $ide;
              $this->name = $name;
              $this->activo = $activo;
              $this->nivel = $nivel;
            }
    }
          
?>