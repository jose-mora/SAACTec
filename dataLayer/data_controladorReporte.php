<?php

include 'connection.php';

class data_controladorReporte {

    public function __construct() {
        
    }
    
    function ejemplo(){
        return "ejemplo!!!";
    }

    function cursosMasSolicitados() {
        global $mysqli;
        $query = "SELECT 
                    cursos.nombre, cursos.nivel, profesores.nombre, profesores.apellido1, 
                    profesores.apellido2, profesores.departamentoEscuela, profesores.email, 
                    procesoasignacion.nombre
                  FROM 
                    profesores
                    INNER JOIN
                        preferencias
                        ON 
                            profesores.email = preferencias.email
                    INNER JOIN
                        grupos 
                        ON 
                            preferencias.ideGrupo = grupos.ideGrupo
                    INNER JOIN 
                        cursos 
                        ON 
                            cursos.id = grupos.idCurso
                  GROUP BY cursos.nivel, profesores.nombre, profesores.apellido1, 
                           profesores.apellido2, profesores.departamentoEscuela, profesores.email
                  ORDER BY cursos.nombre
                  LIMIT 5";
        $result = $mysqli->query($query);

        return $result;
    }

    function cursosMenosSolicitados() {
        global $mysqli;
        $query = "SELECT 
                    cursos.nombre, cursos.nivel, profesores.nombre, profesores.apellido1, 
                    profesores.apellido2, profesores.departamentoEscuela, profesores.email, 
                    procesoasignacion.nombre
                  FROM 
                    profesores
                    INNER JOIN
                        preferencias
                        ON 
                            profesores.email = preferencias.email
                    INNER JOIN
                        grupos 
                        ON 
                            preferencias.ideGrupo = grupos.ideGrupo
                    INNER JOIN 
                        cursos 
                        ON 
                            cursos.id = grupos.idCurso
                  GROUP BY cursos.nivel, profesores.nombre, profesores.apellido1, 
                           profesores.apellido2, profesores.departamentoEscuela, profesores.email
                  ORDER BY cursos.nombre
                  LIMIT 5";
        $result = $mysqli->query($query);

        return $result;
    }
}
?>