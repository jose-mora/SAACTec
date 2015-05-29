<?php

class data_controladorReporte {

    private $host;
    private $dbUser;
    private $dbPassword;
    private $database;
    private $dbTableName;
    private $data;
    private $mysqli;
    private $displayColumns;
    public $excelFileName;

    public function __construct() {
        
    }

    function cursosMasSolicitados() {
        global $mysqli;
        $query = "SELECT 
                    cursos.nombre, cursos.nivel, profesores.nombre, profesores.apellido1, 
                    profesores.apellido2, profesores.departamentoEscuela, profesores.email, 
                    procesoasignacion.nombre
                  FROM 
                    ((resultadoprocasignacion 
                        INNER JOIN 
                            procesoasignacion 
                        ON 
                            procesoasignacion.idProcesoAsignacion = resultadoprocasignacion.idProcesoAsignacion)
                      INNER JOIN 
                            (grupos 
                                INNER JOIN 
                                    cursos 
                                ON 
                                    cursos.id = grupos.idCurso)
                      ON 
                            grupos.ideGrupo = resultadoprocasignacion.ideGrupo)
                    INNER JOIN 
                        profesores 
                    ON 
                        profesores.email = resultadoprocasignacion.email;";
        $result = $mysqli->query($query);

        return $result;
    }

    function cursosMenosSolicitados() {
        global $mysqli;
        $query = "SELECT * FROM profesores WHERE email = '" . $emailProfesor . "'";
        $result = $mysqli->query($query);

        return $result;
    }

}

?>