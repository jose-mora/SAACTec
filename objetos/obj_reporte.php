<?php

class obj_reporte {

    // Creating some properties (variables tied to an object)
    public $nombreCurso;
    public $nivelCurso;
    public $nombreProfesor;
    public $apellido1Profesor;
    public $apellido2Profesor;
    public $departamentoEscuelaProfesor;
    public $emailProfesor;
    public $vecesSolicitado;

    // Assigning the values
    public function __construct($nombreCurso, $nivelCurso, $nombreProfesor, $apellido1Profesor, $apellido2Profesor, 
                                $departamentoEscuelaProfesor, $emailProfesor, $vecesSolicitado) {
        $this->nombreCurso = $nombreCurso;
        $this->nivelCurso = $nivelCurso;
        $this->nombreProfesor = $nombreProfesor;
        $this->apellido1Profesor = $apellido1Profesor;
        $this->apellido2Profesor = $apellido2Profesor;
        $this->departamentoEscuelaProfesor = $departamentoEscuelaProfesor;
        $this->emailProfesor = $emailProfesor;
        $this->vecesSolicitado = $vecesSolicitado;
    }

    public function getNombreCurso() {
        return $this->nombreCurso;
    }

    public function getNivelCurso() {
        return $this->nivelCurso;
    }

    public function getNombreProfesor() {
        return $this->nombreProfesor;
    }

    public function getApellido1Profesor() {
        return $this->apellido1Profesor;
    }

    public function getApellido2Profesor() {
        return $this->apellido2Profesor;
    }

    public function getDepartamentoEscuelaProfesor() {
        return $this->departamentoEscuelaProfesor;
    }

    public function getEmailProfesor() {
        return $this->emailProfesor;
    }

    public function getVecesSolicitado() {
        return $this->vecesSolicitado;
    }
}
?>