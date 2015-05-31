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

     function retornarGruposCompleto(){

        global $mysqli;
        
         $query = "SELECT 
                        grupos.ideGrupo,
                        cursos.nombre 'idCurso',
                        sedes.nombre AS 'idSede',
                        franjas.nombre AS 'idFranja',
                        grupos.activo
                    FROM 
                        grupos INNER JOIN franjas ON franjas.id = grupos.idFranja
                        INNER JOIN sedes on sedes.id = grupos.idsede
                        INNER JOIN cursos on cursos.id = grupos.idCurso";

        $result = $mysqli->query($query);

        return $result;
    }

    function retornarGruposActivos(){

        global $mysqli;
        
        $query = "SELECT * FROM grupos WHERE activo=1";

        $result = $mysqli->query($query);


        return $result;
    }

    function retornarGruposConIDCurso($idCurso){

        global $mysqli;
        
        $query = "SELECT 
                        grupos.ideGrupo,
                        grupos.idCurso,
                        sedes.nombre AS 'idSede',
                        franjas.nombre AS 'idFranja',
                        grupos.activo
                    FROM 
                        grupos INNER JOIN franjas ON franjas.id = grupos.idFranja
                        INNER JOIN sedes on sedes.id = grupos.idsede
                    WHERE 
                        grupos.idCurso=".$idCurso."";
                        
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