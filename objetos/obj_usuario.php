<?php

	class obj_usuario {
            // Creating some properties (variables tied to an object)
            public $tipoUsuario;
            public $usuario;
            public $contrasena;

            // Assigning the values
            public function __construct($tipoUsuario,$usuario,$contrasena) {
              $this->tipoUsuario = $tipoUsuario;
              $this->usuario = $usuario;
              $this->contrasena = $contrasena;
            }
    }       
?>