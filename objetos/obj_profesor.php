<?php

	class obj_profesor {
            // Creating some properties (variables tied to an object)
            public $name;
            public $apellido1;
            public $apellido2;
            public $email;
            public $tel;
            public $ide;

            public $activo;
            
            
            // Assigning the values
             public function __construct($ide,$name, $apellido1, $apellido2, $email,$tel) {
              $this->name = $name;
              $this->apellido1 = $apellido1;
              $this->apellido2 = $apellido2;
              $this->email = $email;
              $this->tel = $tel;
              $this->ide = $ide;

            }

            public function setActivo($activo){
              $this->activo = $activo;
            }
            
            // Creating a method (function tied to an object)
            public function greet() {
              return "Hello, my name is " . $this->name . " " . $this->apellido1 . ". Nice to meet you! :-)";
            }
    }
          
?>