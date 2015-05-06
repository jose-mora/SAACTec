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

    function eliminarPreferencia($ideGrupo,$email){
        
        global $mysqli;

        $query = "DELETE FROM preferencias WHERE ideGrupo = '".$ideGrupo."' AND email = '".$email."'";
        echo $query;
        $mysqli->query($query); 
        $mysqli->close(); 
        

        return 0;
    }

    function cantidadA($email){

        global $mysqli; 
        $query = "SELECT COUNT(*) as cantidad FROM preferencias WHERE nivel ='A' AND email = '". $email ."'";
        $result = $mysqli->query($query);
        $result = $count['cantidad'];
        return $result;
    }

    function retornarPreferenciasProfesor($email){

    	global $mysqli;	
    	$query = "SELECT * FROM preferencias WHERE email ='".$email."'";
		$result = $mysqli->query($query);

		return $result;
    }

}


?>