<?php

include 'connection.php';

class data_controladorCursos {

    public function __construct() {}

	function registrarCurso($nombreCurso){

		global $mysqli;

        $query = "INSERT INTO cursos (nombre) VALUES ('". $nombreCurso . "')";

		$mysqli->query($query);

		$mysqli->close(); 
    	
    	return 0;
		
    }

    function retornarCurso($nombreCurso){
        global $mysqli;
        
        $query = "SELECT * FROM cursos WHERE nombre = '". $nombreCurso ."'";

        $result = $mysqli->query($query);

        return $result;
    }

    function retornarCursos(){

    	global $mysqli;
    	
    	$query = "SELECT * FROM cursos ORDER BY nombre";

		$result = $mysqli->query($query);

		return $result;
    }

    function retornarCursosActivos(){

        global $mysqli;
        
        $query = "SELECT * FROM cursos WHERE activo = 1 ORDER BY nombre";

        $result = $mysqli->query($query);

        return $result;
    }

    function gestionarCurso($cursoGest,$valor){

        global $mysqli;

        $query = "UPDATE cursos SET activo=". $valor ." WHERE nombre='".$cursoGest."'";

        $mysqli->query($query);

        $mysqli->close(); 
        
        return 0;
    }
}


?>