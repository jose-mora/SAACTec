<?php

include 'connection.php';

/**
* Data access para el manejo de profesores
*/
class data_controladorProfesores
{
	
	function __construct(){}

        //$nom,$ap1,$ap2,$email,$tel,$jor,$niv
	function registrarProfesores($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2,
                                     $email, $tel, $cel, $jor, $direccion){

		global $mysqli;

		$query = "";
        $query = "INSERT INTO profesores(tipoProfesor, departamentoEscuela, gradoAcademicoProfesor, cedula, nombre, apellido1, apellido2, email, "
               . "telefono, celular, evaluacionActual, activo, jornada, direccion, nivel) ";
        $query = $query. "VALUES ('". $tipoProfesor . "','". $departamentoEscuela . "','". $gradoAcademicoProfesor . "','". $cedula . "','"
                . $nom . "','". $ap1 . "','". $ap2 . "','". $email . "','". $tel . "','". $cel . "',70, 1,'". $jor . "','". $direccion . "','1')";

        $mysqli->query($query);
        //$mysqli->close(); 
       
        return 0;
        
    }

    function retornarProfesores(){

    	global $mysqli; 
        $query = "SELECT * FROM profesores WHERE email = '". $emailProfesor ."'";
        $result = $mysqli->query($query);

        return $result;

    }

    function retonarProfesor($criterio,$valor){

    	global $mysqli; 
        $query = "";

    	if ($criterio == "nombre") {
    		$query = "SELECT * FROM profesores WHERE nombre LIKE '%$valor%'";
    	}elseif ($criterio == "apellido1") {
    		$query = "SELECT * FROM profesores WHERE apellido1 LIKE '%$valor%'";
    	}elseif ($criterio == "apellido2") {
    		$query = "SELECT * FROM profesores WHERE apellido2 LIKE '%$valor%'";
    	}else{
    		$query = "SELECT * FROM profesores WHERE email LIKE '%$valor%'";
    	}

    	$result = $mysqli->query($query);

        return $result;
    }

    function retornarProfesor($emailProfesor){

    	global $mysqli; 
        $query = "SELECT * FROM profesores WHERE email = '". $emailProfesor ."'";
        $result = $mysqli->query($query);

        return $result;
    }


    function retornarProfesoresActivos(){

        global $mysqli;
        
        $query = "SELECT * FROM profesores WHERE activo = 1 ORDER BY 'apellido1'";
        $result = $mysqli->query($query);

        return $result;
    }

    function gestionarProfesor($emailProfesor,$valor){

    	global $mysqli;

        $query = "UPDATE profesores SET activo=". $valor ." WHERE email='".$emailProfesor."'";

        $mysqli->query($query);

        $mysqli->close(); 
        
        return 0;
    }

    function actualizarProfesor($tp, $de, $ga, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion){

        global $mysqli;

        $query = "UPDATE profesores SET tipoProfesor='". $tp ."',departamentoEscuela='". $de ."',gradoAcademicoProfesor='". $ga ."',cedula='". $cedula ."', nombre='". $nom ."',".
        " apellido1='". $ap1 ."', apellido2='". $ap2 ."', email='". $email ."', telefono='". $tel."', celular='". $cel ."', jornada='". $jor ."', direccion='". $direccion ."' WHERE email='".$email."'";

        $mysqli->query($query);
        
        return 0;
    }

    function actualizarEvaluacion($emailProfesor,$evaluacion){
    	global $mysqli;

    	$query = "UPDATE profesores SET evaluacionActual=". $evaluacion ." WHERE nombre='".$emailProfesor."'";

        $mysqli->query($query);

        $mysqli->close(); 
        
        return 0;

    }
}

?>