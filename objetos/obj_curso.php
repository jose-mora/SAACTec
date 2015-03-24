<?php

	class obj_curso {
            // Creating some properties (variables tied to an object)
            public $name;
            public $activo;
            public $ide;
            
            // Assigning the values
            public function __construct($ide,$name,$activo) {
              $this->ide = $ide;
              $this->name = $name;
              $this->activo = $activo;
            }
    }
          
?>