<?php

include 'connection.php';

class data_controladorResultadoProcAsignacion{

    public function __construct() {}

    
    function registrarResultadoProcAsignacion($idProcesoAsignacion, $ideGrupo, $email){

    	global $mysqli;

    	$query = "INSERT INTO
    				resultadoprocasignacion (idProcesoAsignacion, ideGrupo, email)
    			  VALUES
    			    ('".$idProcesoAsignacion."','".$ideGrupo."','".$email."')";

    	$mysqli->query($query);
       
        return 0;
    }

    function eliminarResultadoProcAsignacion($idProcesoAsignacion){

        global $mysqli;

        $query = "DELETE FROM
                    resultadoprocasignacion
                  WHERE
                    idProcesoAsignacion = '".$idProcesoAsignacion."'";

        //echo $query;
        $mysqli->query($query);
       
        return 0;
    }

    //¿Agregar nivel de preferencia?
    function retornarResultadoProcAsignacion($idProcesoAsignacion){

        global $mysqli;

        $query ="SELECT 
                    procesoasignacion.nombre 'proceso',
                    sedes.nombre AS 'sede',
                    cursos.nombre AS 'curso',
                    grupos.ideGrupo,
                    franjas.nombre AS 'franja',
                    CONCAT(profesores.nombre , ' ' , profesores.apellido1 , ' ' , profesores.apellido2) AS 'profesor'
                FROM 
                    resultadoprocasignacion INNER JOIN procesoasignacion ON procesoasignacion.idProcesoAsignacion = resultadoprocasignacion.idProcesoAsignacion
                    INNER JOIN grupos ON grupos.ideGrupo = resultadoprocasignacion.ideGrupo
                    INNER JOIN cursos ON cursos.id = grupos.idCurso
                    INNER JOIN franjas ON franjas.id = grupos.idFranja
                    INNER JOIN sedes ON sedes.id = grupos.idSede
                    INNER JOIN profesores ON resultadoprocasignacion.email = profesores.email
                WHERE
                    resultadoprocasignacion.idProcesoAsignacion = ".$idProcesoAsignacion.""; 

        $result = $mysqli->query($query);

        return $result;
    }
}

?>