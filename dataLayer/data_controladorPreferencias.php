<?php

include 'connection.php';

class data_controladorPreferencias {

    public function __construct() {}

	function registrarPreferencia($email,$grupo,$nivel){

		global $mysqli;

        $query = "INSERT INTO preferencias (email,ideGrupo,nivel) VALUES ('". $email . "','". $grupo . "','". $nivel . "')";
		$mysqli->query($query);
    	
    	return 0;
		
    }

    function eliminarPreferencia($ideGrupo,$email,$rank){
        
        global $mysqli;

        $query = "DELETE FROM preferencias WHERE ideGrupo = '".$ideGrupo."' AND email = '".$email."' AND nivel = '".$rank."'";

        //echo $query;
        $mysqli->query($query); 
        

        return 0;
    }

    function cantidadA($email){

        global $mysqli; 
        $cantidadA = 0;
        $query = "SELECT COUNT(*) as cantidad FROM preferencias WHERE nivel ='A' AND email = '". $email ."'";
        $result = $mysqli->query($query);

        while ($obj = $result->fetch_assoc()) {

            $cantidadA = $obj['cantidad'];
        }

        return $cantidadA;
    }

    function retornarPreferenciasProfesor($email){

    	global $mysqli;	
    	$query = "SELECT * FROM preferencias WHERE email ='".$email."'";
		$result = $mysqli->query($query);

		return $result;
    }

    function gestionarPreferencias($email,$valor){

        global $mysqli;

        $query = "UPDATE preferencias SET activo=". $valor ." WHERE email='".$email."'";
        $mysqli->query($query);
        
        return 0;
    }

}


?>