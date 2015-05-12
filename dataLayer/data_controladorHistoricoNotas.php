<?php

include 'connection.php';

/**
 * Data access para el manejo de profesores
 */
class data_controladorHistoricoNotas {

    function __construct() {
        
    }

    function registrarNota($idProfesor, $periodo, $nota, $anular) {
        global $mysqli;

        $query = "INSERT INTO historiconotas
                                            (idProfesor, periodo, nota, anular)
                  VALUES 
                                            (".$idProfesor.",'".$periodo."', '".$nota."', ".$anular.")";

        $mysqli->query($query);

        return 0;
    }
    
    function retornarNotas($idProfesor){
        global $mysqli;
        
        $query = "SELECT *
                  FROM historiconotas 
                  WHERE idProfesor = '". $idProfesor ."'
                  ORDER BY periodo";

        $result = $mysqli->query($query);

        return $result;
    }
    
    function anularNota($idProfesor, $tiempo, $modalidad, $periodoLectivo, $anular) {
        global $mysqli;
        
        $query = "UPDATE historiconotas
                  SET anular= ".$anular." 
                  WHERE idProfesor = '". $idProfesor ."'
                  AND periodo= '".$tiempo." ".$modalidad." ".$periodoLectivo."'";

        $mysqli->query($query);

        return 0;
    }
}

?>