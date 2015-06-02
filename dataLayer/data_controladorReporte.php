<?php

include 'connection.php';

class data_controladorReporte {

    public function __construct() {
        
    }

    function cursosMasSolicitados() {
        global $mysqli;
        $query = "SELECT 
                    cursos.nombre AS nombre_curso, cursos.nivel AS nivel_curso, profesores.nombre AS nombre_profesor, profesores.apellido1, 
                    profesores.apellido2, profesores.departamentoEscuela, profesores.email,
                    COUNT(cursos.nombre) AS veces_solicitado
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
                  ORDER BY cursos.nombre desc
                  LIMIT 5";
        $result = $mysqli->query($query);

        return $result;
    }

    function cursosMenosSolicitados() {
        global $mysqli;
        $query = "SELECT 
                    cursos.nombre AS nombre_curso, cursos.nivel AS nivel_curso, profesores.nombre AS nombre_profesor, profesores.apellido1, 
                    profesores.apellido2, profesores.departamentoEscuela, profesores.email,
                    COUNT(cursos.nombre) AS veces_solicitado
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
                  ORDER BY cursos.nombre asc
                  LIMIT 5";
        $result = $mysqli->query($query);

        return $result;
    }
}
?>