<?php

include 'connection.php';

class data_controladorGrupos {

    public function __construct() {}

	function registrarGrupo($ideGrupo, $idSede, $idCurso,$idFranja){   

		global $mysqli;

        $query = "INSERT INTO grupos (ideGrupo,idSede,idCurso,idFranja) VALUES ('". $ideGrupo . "','".$idSede."','".$idCurso."','".$idFranja."')";

		$mysqli->query($query);

		$mysqli->close(); 
    	
    	return 0;
		
    }

    function retornarGrupos(){

    	global $mysqli;
    	
    	$query = "SELECT * FROM grupos";

		$result = $mysqli->query($query);


		return $result;
    }

    function gestionarGrupo($grupoGest,$valor){

        global $mysqli;

        $query = "UPDATE grupos SET activo=". $valor ." WHERE ideGrupo='".$grupoGest."'";

        $mysqli->query($query);

        $mysqli->close(); 
        
        return 0;
    }
}


?>