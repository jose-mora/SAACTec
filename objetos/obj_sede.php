<?php

	class obj_sede {
            // Creating some properties (variables tied to an object)
            public $name;
            public $ide;
            public $activo;
            
            // Assigning the values
            public function __construct($ide,$name,$activo) {
              $this->ide = $ide;
              $this->name = $name;
              $this->activo = $activo;
            }

    }
          
?>