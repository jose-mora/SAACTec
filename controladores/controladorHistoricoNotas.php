<?php

//include('dataLayer/controladorBaseDatos.php');

/**
 * Clase para el mantenimiento de profesores
 */
class controladorHistoricoNotas {

    function __construct() {
        
    }

    function registrarNota($obj) {
        $controlador = new controladorBaseDatos ();

        $idProfesor = $obj->idProfesor;
        $periodo = $obj->periodo;
        $nota = $obj->nota;
        $anular = $obj->anular;

        $notas = $controlador->retornarNotas($idProfesor);

        $insertar = true;

        for ($i = 0; $i < (count($notas)); $i++) {
            $objNuevo = $notas[$i];

            if (strcasecmp($obj->idProfesor, $objNuevo->idProfesor) == 0) {
                if (strcasecmp($obj->periodo, $objNuevo->periodo) == 0) {
                    if (strcasecmp($obj->nota, $objNuevo->nota) == 0) {
                        if (strcasecmp($obj->anular, $objNuevo->anular) == 0) {
                            $insertar = false;
                            break;
                        }
                    }
                }
            }
        }

        if ($insertar) {
            return $controlador->registrarNota($idProfesor, $periodo, $nota, $anular);
        } else {
            return 1;
        }
    }

    function retornarNotas($idProfesor) {
        $controlador = new controladorBaseDatos();
        return $controlador->retornarNotas($idProfesor);
    }

    function anularNota($idProfesor, $tiempo, $modalidad, $periodoLectivo, $anular) {
        $controlador = new controladorBaseDatos();
        return $controlador->anularNota($idProfesor, $tiempo, $modalidad, $periodoLectivo, $anular);
    }

}

?>