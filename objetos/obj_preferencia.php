<?php

	class obj_preferencia {
            // Creating some properties (variables tied to an object)
            public $email;
            public $rank;
            public $ideGrupo;
            
            // Assigning the values
            public function __construct($email,$rank,$ideGrupo) {
              $this->email = $email;
              $this->rank = $rank;
              $this->ideGrupo = $ideGrupo;
            }

    }

    class obj_preferenciaDetallada{
      public $email;
      public $rank;
      public $ideGrupo;
      public $curso;
      public $horario;
      
      // Assigning the values
      public function __construct($email,$rank,$ideGrupo,$curso,$horario) {
        $this->email = $email;
        $this->rank = $rank;
        $this->ideGrupo = $ideGrupo;
        $this->curso = $curso;
        $this->horario = $horario;
      }
    }
          
?>