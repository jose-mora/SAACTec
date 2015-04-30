<?php

	class obj_profesor {
            // Creating some properties (variables tied to an object)
            public $ide;
            public $tipoProfesor;
            public $departamentoEscuela;
            public $gradoAcademicoProfesor;
            public $cedula;
            public $name;
            public $apellido1;
            public $apellido2;
            public $email;
            public $tel;
            public $cel;            
            public $jornada;            
            public $direccion;
            //public $notas;
            public $nivel;
            public $activo;
            
            
            // Assigning the values
            /*public function __construct($ide, $name, $apellido1, $apellido2, $email, $tel) {
              $this->ide = $ide;
              $this->name = $name;
              $this->apellido1 = $apellido1;
              $this->apellido2 = $apellido2;
              $this->email = $email;
              $this->tel = $tel;              
            }
            
            public function __construct($ide, $name, $apellido1, $apellido2, $email, $tel, $jornada, $nivel) {              
              $this->ide = $ide;
              $this->name = $name;
              $this->apellido1 = $apellido1;
              $this->apellido2 = $apellido2;
              $this->email = $email;
              $this->tel = $tel;
              $this->jornada = $jornada;
              $this->nivel = $nivel;
            }*/
            
            public function __construct($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $name, $lastname, $lastname2,
                                         $email, $tel, $cel, $jornadaLaboral, $direccion) {                            
              $this->tipoProfesor = $tipoProfesor;

              $this->departamentoEscuela = $departamentoEscuela;
              $this->gradoAcademicoProfesor = $gradoAcademicoProfesor;
              $this->cedula = $cedula;

              $this->name = $name;
              echo "EL NOMBRE ES: ". $name;
              $this->apellido1 = $lastname;
              $this->apellido2 = $lastname2;
              $this->email = $email;
              $this->tel = $tel;
              $this->cel = $cel;
              $this->jornada = $jornadaLaboral;
              $this->direccion = $direccion;
              //$this->notas = $notas;
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