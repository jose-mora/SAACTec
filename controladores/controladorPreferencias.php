<?php

/**
 * Clase para el mantenimiento de profesores
 */
class controladorPreferencias {

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

}

?>