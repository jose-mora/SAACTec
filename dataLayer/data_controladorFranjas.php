<?php

include 'connection.php';

class data_controladorFranjas {

    public function __construct() {}

	function registrarFranja($nombreFranja){

		global $mysqli;

        $query = "INSERT INTO franjas (nombre) VALUES ('". $nombreFranja . "')";

		$mysqli->query($query);

		$mysqli->close(); 
    	

    	return 0;
		
    }

    function retornarFranja($nombreFranja){

        global $mysqli;
        
        $query = "SELECT * FROM franjas WHERE nombre = '". $nombreFranja ."'";

        $result = $mysqli->query($query);


        return $result;
    }

    function retornarFranjas(){

    	global $mysqli;
    	
    	$query = "SELECT * FROM franjas";

		//$result = mysql_query($query);
		$result = $mysqli->query($query);


		return $result;
    }

    function retornarFranjasActivas(){

        global $mysqli;
        
        $query = "SELECT * FROM franjas WHERE activo = 1 ORDER BY nombre";

        $result = $mysqli->query($query);

        return $result;
    }

    function gestionarFranja($franjaGest,$valor){

        global $mysqli;
        $query = "UPDATE franjas SET activo=". $valor ." WHERE nombre='".$franjaGest."'";

        $mysqli->query($query);

        $mysqli->close(); 
        
        return 0;
    }
}


?>