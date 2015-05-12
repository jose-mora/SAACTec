<?php

class obj_nota {

    // Creating some properties (variables tied to an object)
    public $idHistoricoNota;
    public $idProfesor;
    public $periodo;
    public $nota;
    public $anular;

    public function __construct($idProfesor, $periodo, $nota, $anular) {
        $this->idProfesor = $idProfesor;
        $this->periodo = $periodo;
        $this->nota = $nota;
        $this->anular = $anular;
    }

    public function setAnular($anular) {
        $this->anular = $anular;
    }
    
    public function setIdHistoricoNota($idHistoricoNota) {
        $this->idHistoricoNota = $idHistoricoNota;
    }
}

?>