<?php

	class obj_asignacionProfesor {
            // Creating some properties (variables tied to an object)
            public $email;
            public $ultimaNota;
            public $cantidadNotas;
            public $promedioNotas;
            public $porcentajeProfesor;
            public $porcentajeOcupado;
          
            
            public function __construct() {                            
              
            }


            public function setEmail($email){
              $this->email = $email;
            }


            public function setUltimaNota($ultimaNota){
              $this->ultimaNota = $ultimaNota;
            }

            public function setCantidadNotas($cantidadNotas){
              $this->cantidadNotas = $cantidadNotas;
            }
            
            public function setPromedioNotas($promedioNotas){
              $this->promedioNotas = $promedioNotas;
            }
            
            public function setPorcentajeProfesor($porcentajeProfesor){
              $this->porcentajeProfesor = $porcentajeProfesor;
            }
            
            public function setPorcentajeOcupado($porcentajeOcupado){
              $this->porcentajeOcupado = $porcentajeOcupado;
            }

            // Creating a method (function tied to an object)
            public function greet() {
              return "Hello, my name is " . $this->email . " " . $this->promedioNotas . ". Nice to meet you! :-) <br/>";
            }
    }
          
?>