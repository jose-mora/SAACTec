<?php

//include('dataLayer/controladorBaseDatos.php');

/**
 * Clase para el mantenimiento de profesores
 */
class controladorProfesores {

    function __construct() {
        
    }

    function registrarProfesores($obj) {

        $controlador = new controladorBaseDatos(); //llamamos al controlador de base de datos
        
        $tipoProfesor = $obj->tipoProfesor;
        $departamentoEscuela = $obj->departamentoEscuela;
        $gradoAcademicoProfesor = $obj->gradoAcademicoProfesor;
        $cedula = $obj->cedula;
        $nom = $obj->name;
        $ap1 = $obj->apellido1;
        $ap2 = $obj->apellido2;
        $email = $obj->email;
        $tel = $obj->tel;
        $cel = $obj->cel;
        $jor = $obj->jornada;
        $direccion = $obj->direccion;
        //$notas = $obj->notas;
        $niv = $obj->nivel;//TODO: Creo que este no tengo que usarlo
        
        //return $controlador->registrarProfesores($nom, $ap1, $ap2, $email, $tel, $jor, $niv);
        return $controlador->registrarProfesores($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion);
    }

    function actualizarProfesor($obj, $emailOri) {

        $controlador = new controladorBaseDatos(); //llamamos al controlador de base de datos

        $emailNuevo = $obj->email;
        $tipoProfesor = $obj->tipoProfesor;
        $departamentoEscuela = $obj->departamentoEscuela;
        $gradoAcademicoProfesor = $obj->gradoAcademicoProfesor;
        $cedula = $obj->cedula;
        $nom = $obj->name;
        $ap1 = $obj->apellido1;
        $ap2 = $obj->apellido2;
        $email = $obj->email;
        $tel = $obj->tel;
        $cel = $obj->cel;
        $jor = $obj->jornada;
        $direccion = $obj->direccion;

        if ($emailOri != $emailNuevo) { //si el email cambio debemos fijarnos si ya el nuevo esta utilizado
            $profesor = $this->retornarProfesor($emailNuevo);

            if ($profesor) { //ya existe, devolvemos error

                //echo " ya existe el correo electr&oacute;";
                return 12;

            } else {
                return $controlador->actualizarProfesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion, $emailOri);
            }
        } else {
            return $controlador->actualizarProfesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion, $emailOri);
        }
    }

    function retonarProfesor($criterio, $valor) {

        $criterioReal = "";

        if ($criterio == "Nombre") {
            $criterioReal = "nombre";
        } elseif ($criterio == "Primer Apellido") {
            $criterioReal = "apellido1";
        } elseif ($criterio == "Segundo Apellido") {
            $criterioReal = "apellido2";
        } else {
            $criterioReal = "email";
        }

        $controlador = new controladorBaseDatos();
        return $controlador->retonarProfesor($criterioReal, $valor);
    }

    function retornarProfesores() {
        
    }

    function retornarProfesor($emailProfesor) {
        $controlador = new controladorBaseDatos();
        return $controlador->retornarProfesor($emailProfesor);
    }

    function retornarTodosLosProfesores() {
        $controlador = new controladorBaseDatos();
        return $controlador->retornarTodosLosProfesores();
    }

    function gestionarProfesor($emailProfesor, $valor) {
        $controlador = new controladorBaseDatos();
        return $controlador->gestionarProfesor($emailProfesor, $valor);
    }

    function retornarProfesoresActivos() {
        //echo "  PROFESORES ACTIVOS /  ";
        $controlador = new controladorBaseDatos();
        return $controlador->retornarProfesoresActivos();
    }

}

?>