<?php

include 'connection.php';

class data_controladorAsignacion {

    public function __construct() {}

	function retornarProfesoresActivosparaPreferenciasValidas($ideGrupo){

		global $mysqli;

        $query = "SELECT * FROM profesores WHERE email in (SELECT email FROM preferencias WHERE ideGrupo = '".$ideGrupo."' and activo = 1 and gastada = 0) and activo =1 ORDER BY activo ASC";
        //echo $query;
		$result = $mysqli->query($query);

        return $result;
		
    }

    function preferenciasdeGrupoxProfesorxNivel($email,$ideGrupo,$nivel){

        global $mysqli;

        $query = "SELECT * FROM `preferencias` WHERE `email`='".$email."' AND `ideGrupo`='".$ideGrupo."' AND `nivel`='".$nivel."' AND `activo`=1 AND `gastada`=0";
        //echo $query;
        $result = $mysqli->query($query);

        return $result;



    }

    function retornarUltimaNotaProfesor($email){

        global $mysqli;

        $query = "SELECT * FROM `historiconotas` 
                    WHERE `idhistoriconotas` IN 
                    (SELECT MAX(HN.idhistoriconotas)from historiconotas AS HN INNER JOIN profesores as PR on HN.idProfesor = PR.id WHERE PR.email = '".$email."') AND anular = 0";
        //echo $query;
        $result = $mysqli->query($query);

        return $result;

        
    }

    function tieneDisponibilidad($email,$ideProceso){
        global $mysqli;

        $query = "SELECT COUNT(*) as 'cantidad' FROM `resultadoprocasignacion` where email='".$email."' AND idProcesoAsignacion=". $ideProceso ."";
        //echo $query;
        $result = $mysqli->query($query);

        return $result;   
    }

    function retornarPromedioYCantidad($email){

        global $mysqli;

        $query = "SELECT AVG(nota) AS 'nota' , COUNT(*) as 'cantidad' FROM `historiconotas` where idProfesor IN (SELECT id FROM `profesores` WHERE email='".$email."')";
        //echo $query;
        $result = $mysqli->query($query);

        return $result;

        
    }

   
}


?>