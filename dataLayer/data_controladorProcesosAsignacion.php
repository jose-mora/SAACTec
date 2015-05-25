<?php

include 'connection.php';

class data_controladorProcesosAsignacion{

    public function __construct() {}

    
    function registrarProcesoAsignacion($nombre){

    	global $mysqli;

    	$query = "INSERT INTO
    				procesoasignacion (nombre, activo, ejecutado)
    			  VALUES
    			    ('".$nombre."','0','0')";

    	$mysqli->query($query);
       
        return 0;
    }

    function activarProcesosAsignacion($nombre,$activo){

        global $mysqli;

        $query = "UPDATE
                    procesoasignacion
                  SET
                    activo = '".$activo."'
                  WHERE
                    nombre = '".$nombre."'";

        $mysqli->query($query);
       
        return 0;
    }

    function ejecutarProcesosAsignacion($idProcesoAsignacion,$ejecutar){

        global $mysqli;

        $query = "UPDATE
                    procesoasignacion
                  SET
                    ejecutado = '".$ejecutar."'
                  WHERE
                    idProcesoAsignacion = '".$idProcesoAsignacion."'";

        $mysqli->query($query);
       
        return 0;
    }

    function retornarProcesosAsignacion(){

        global $mysqli;

        $query = "SELECT 
                    *
                  FROM 
                    procesoasignacion"; 

        $result = $mysqli->query($query);

        return $result;
    }

    function retornarProcesosAsignacionActivos(){

        global $mysqli;

        $query = "SELECT 
                    *
                  FROM 
                    procesoasignacion
                  WHERE activo = 1"; 

        $result = $mysqli->query($query);

        return $result;
    }

    function retornarProcesosAsignacionxNombre($nombre){

        global $mysqli;

        $query = "SELECT 
                    *
                  FROM 
                    procesoasignacion
                  WHERE nombre = '".$nombre."'"; 

        $result = $mysqli->query($query);

        return $result->num_rows;
    }
}

?>