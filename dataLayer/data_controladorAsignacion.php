<?php

include 'connection.php';

class data_controladorAsignacion {

    public function __construct() {}

	function retornarProfesoresActivosparaPreferenciasValidas($ideGrupo){

		global $mysqli;

        $query = "SELECT * FROM profesores WHERE email in (SELECT email FROM preferencias WHERE ideGrupo = '".$ideGrupo."' and activo = 1 and gastada = 0) and activo =1 ORDER BY activo ASC";

		$mysqli->query($query);
		$mysqli->close(); 
    	
    	return 0;
		
    }

   
}


?>