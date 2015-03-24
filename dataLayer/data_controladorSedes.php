<?php

include 'connection.php';

class data_controladorSedes {

    public function __construct() {}

	function registrarSede($nombreSede){

		global $mysqli;

        $query = "INSERT INTO sedes (nombre) VALUES ('". $nombreSede . "')";
		$mysqli->query($query);
		$mysqli->close(); 
    	
    	return 0;
		
    }

    function retornarSede($nombreSede){

        global $mysqli; 
        $query = "SELECT * FROM sedes WHERE nombre = '". $nombreSede ."'";
        $result = $mysqli->query($query);

        return $result;
    }

    function retornarSedes(){

    	global $mysqli;	
    	$query = "SELECT * FROM sedes ORDER BY nombre";
		$result = $mysqli->query($query);

		return $result;
    }

    function retornarSedesActivas(){

        global $mysqli;
        
        $query = "SELECT * FROM sedes WHERE activo = 1 ORDER BY nombre";

        $result = $mysqli->query($query);

        return $result;
    }

    function eliminarSede($sedeElim){
        
        global $mysqli;

        $query = "DELETE FROM sedes WHERE  nombre = '". $sedeElim . "'";
        $mysqli->query($query);
        $mysqli->close(); 
        

        return 0;
    }

    function gestionarSedes($sedeGest,$valor){

        global $mysqli;

        $query = "UPDATE sedes SET activo=". $valor ." WHERE nombre='".$sedeGest."'";

        $mysqli->query($query);

        $mysqli->close(); 
        
        return 0;
    }
}


?>