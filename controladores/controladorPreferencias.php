<?php

include('dataLayer/controladorBaseDatos.php');

/**
 * Clase para el mantenimiento de profesores
 */
class controladorProfesores {

    function __construct() {
        
    }
    

    function registrarPreferencia($email,$grupo,$nivel){

        $cont = new controladorBaseDatos();
        return $cont->registrarPreferencia($email,$grupo,$nivel);
        
    }

    function eliminarPreferencia($ideGrupo,$email){
        
        $cont = new controladorBaseDatos();
        return $cont->eliminarPreferencia($ideGrupo,$email);
        
    }

    function cantidadA($email){

        $cont = new controladorBaseDatos();
        return $cont->cantidadA($email);
    }

    function retornarPreferenciasProfesor($email){

        $cont = new controladorBaseDatos();
        return $cont->retornarPreferenciasProfesor($email);
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

                echo " ya existe el correo electr&oacute;";
                return 12;

            } else {
                return $controlador->actualizarProfesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion);
            }
        } else {
            return $controlador->actualizarProfesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion);
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

}

?>