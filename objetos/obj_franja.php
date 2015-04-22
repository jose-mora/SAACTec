<?php

	class obj_franja {
            // Creating some properties (variables tied to an object)
            public $name;
            public $dia;
            public $ide;
            public $activo;
            
            // Assigning the values
            public function __construct($name,$ide,$activo) {
              $this->name = $name;
              $this->ide = $ide;
              //$this->dia = $dia;
              $this->activo = $activo;
            }
    }
          
?>