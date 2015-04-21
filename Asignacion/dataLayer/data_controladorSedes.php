<?php

include 'connection.php';

class data_controladorSedes {

    public function __construct() {
        
    }

    function registrarSede($nombreSede) {

        global $mysqli;

        $query = "INSERT INTO sede (nombresede, activo, creadopor, modificadopor, fechacreacion, fechamodificacion)"
                . " VALUES ('" . $nombreSede . "',0,1,1,'2015-04-20','2015-04-20')";
        $mysqli->query($query);
        $mysqli->close();

        return 0;
    }

    function retornarSede($nombreSede) {

        global $mysqli;
        $query = "SELECT * FROM sede WHERE nombresede = '" . $nombreSede . "'";
        $result = $mysqli->query($query);

        return $result;
    }

    function retornarSedes() {

        global $mysqli;
        $query = "SELECT idsede, nombresede, activo FROM sede ORDER BY nombresede";
        $result = $mysqli->query($query);

        return $result;
    }

    function retornarSedesActivas() {

        global $mysqli;

        $query = "SELECT * FROM sede WHERE activo = 1 ORDER BY nombresede";

        $result = $mysqli->query($query);

        return $result;
    }

    function eliminarSede($sedeElim) {

        global $mysqli;

        $query = "DELETE FROM sede WHERE  nombresede = '" . $sedeElim . "'";
        $mysqli->query($query);
        $mysqli->close();


        return 0;
    }

    function gestionarSedes($sedeGest, $valor) {

        global $mysqli;

        $query = "UPDATE sede SET activo=" . $valor . " WHERE nombresede='" . $sedeGest . "'";

        $mysqli->query($query);

        $mysqli->close();

        return 0;
    }

}

?>