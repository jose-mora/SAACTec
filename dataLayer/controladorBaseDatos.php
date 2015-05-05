<?php

include('data_controladorSedes.php');
include('data_controladorFranjas.php');
include('data_controladorCursos.php');
include('data_controladorGrupos.php');
include('data_controladorProfesores.php');

class controladorBaseDatos {

    public function __construct() {
        
    }

    /*     * ******************************************************************************************************** PROFESORES

      Operaciones con  profesores

      /************************ */

    /*

      $tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2,
      $email, $tel, $cel, $jor, $direccion, $notas
     */

    //$nom,$ap1,$ap2,$email,$tel,$jor,$niv
    function registrarProfesores($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion/* , $notas */) {

        $profs = $this->retornarProfesor($email);
        $nombre = "";
        /*if (count($profs) > 0) {
            while ($obj = $profs->fetch_assoc()) {
                $nombre = $obj['nombre'];
            }
        }*/
        
        if ($profs){
            return 1;
        }
        else{
            $cont = new data_controladorProfesores();
            //$nom,$ap1,$ap2,$email,$tel,$jor,$niv
            return $cont->registrarProfesores($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion);
        }

//        if ($nombre != "") {
//            return 1;
//        } else {
//            $cont = new data_controladorProfesores();
//            //$nom,$ap1,$ap2,$email,$tel,$jor,$niv
//            return $cont->registrarProfesores($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion);
//        }
    }

    function actualizarProfesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion){

        $cont = new data_controladorProfesores();
        return $cont->actualizarProfesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion);
    }

    function retonarProfesor($criterio, $valor) {
        $cont = new data_controladorProfesores();
        $result = $cont->retonarProfesor($criterio, $valor);

        $array = array();

        while ($obj = $result->fetch_assoc()) {
            $newProf = new obj_profesor($obj['tipoProfesor'], $obj['departamentoEscuela'], $obj['gradoAcademicoProfesor'], $obj['cedula'], $obj['nombre'], $obj['apellido1'], $obj['apellido2'], $obj['email'], $obj['telefono'], $obj['celular'], $obj['jornada'], $obj['direccion'], $obj['nivel']);
            $newProf->setActivo($obj['activo']);
            $array[] = $newProf;
        }

        //$newProf1 =  new obj_profesor('1','Jesus','Mora','Garcia','test1@gmail.com','2232-2020','50%','Master');
        //$newProf2 =  new obj_profesor($obj['id'],$obj['nombre'],$obj['apellido1'],$obj['apellido2'],$obj['email'],$obj['telefono'],$obj['jornada'],$obj['nivel']);
        //$array[] = $newProf1;

        return $array;
    }

    function retornarProfesores() {
        $cont = new data_controladorProfesores();
        return $cont->retornarProfesores();
    }

    function retornarProfesor($emailProfesor) {
        $cont = new data_controladorProfesores();
        $result = $cont->retornarProfesor($emailProfesor);        
        $array = array();
        while ($obj = $result->fetch_assoc()) {
            $newProf = new obj_profesor($obj['tipoProfesor'], $obj['departamentoEscuela'], $obj['gradoAcademicoProfesor'], $obj['cedula'], $obj['nombre'], $obj['apellido1'], $obj['apellido2'], $obj['email'], $obj['telefono'], $obj['celular'], $obj['jornada'], $obj['direccion'], $obj['nivel']);
            $newProf->setActivo($obj['activo']);
            $array[] = $newProf;
        }

        if (count($array) > 0) {
            return $array[0];
        } else {
            return null;
        }
    }

    function gestionarProfesor($emailProfesor, $valor) {
        $cont = new data_controladorProfesores();
        return $cont->gestionarProfesor($emailProfesor, $valor);
    }

    function actualizarEvaluacion($emailProfesor, $evaluacion) {
        $cont = new data_controladorProfesores();
        return $cont->actualizarEvaluacion($emailProfesor, $evaluacion);
    }

    function retornarProfesoresActivos() {

        //echo "BASE DE DATOS /  ";
        $cont = new data_controladorProfesores();
        $result = $cont->retornarProfesoresActivos();
        $array = array();

        while ($obj = $result->fetch_assoc()) {

            //$array[] = new obj_profesor($obj['id'], $obj['nombre'], $obj['apellido1'], $obj['apellido2'], $obj['email'], $obj['telefono'], $obj['jornada'], $obj['nivel'])
            $array[] = new obj_profesor($obj['tipoProfesor'], $obj['departamentoEscuela'], $obj['gradoAcademicoProfesor'], $obj['cedula'], $obj['nombre'], $obj['apellido1'], $obj['apellido2'], $obj['email'], $obj['telefono'], $obj['celular'], $obj['jornada'], $obj['direccion'], $obj['nivel']);
        }

        return $array;
    }

    /*     * ************************************************************************************************** SEDES

      Operaciones con  sedes

      /************************ */

    function insertarSede($nombreSede) {

        $cont = new data_controladorSedes();
        return $cont->registrarSede($nombreSede);
    }

    function retornarSedes() {

        $cont = new data_controladorSedes();
        $result = $cont->retornarSedes();
        $array = array();

        while ($obj = $result->fetch_assoc()) {
            $array[] = new obj_sede($obj['id'], $obj['nombre'], $obj['activo']);
        }

        return $array;
    }

    function eliminarSede($sedeElim) {

        $cont = new data_controladorSedes();
        return $cont->eliminarSede($sedeElim);
    }

    function retornarSede($nombreSede) {

        $cont = new data_controladorSedes();
        $result = $cont->retornarSede($nombreSede);
        $obj = $result->fetch_assoc();
        $objSede = new obj_sede($obj['id'], $obj['nombre'], $obj['activo']);

        return $objSede;
    }

    function retornarSedesActivas() {

        $cont = new data_controladorSedes();
        $array = array();

        $result = $cont->retornarSedesActivas();

        while ($obj = $result->fetch_assoc()) {
            $array[] = new obj_sede($obj['id'], $obj['nombre'], $obj['activo']);
        }

        return $array;
    }

    function gestionarSedes($sedeGest, $valor) {
        $cont = new data_controladorSedes();
        return $cont->gestionarSedes($sedeGest, $valor);
    }

    /*     * ******************************************************************************************************** FRANJAS

      Operaciones con  franjas

      /************************ */

    function insertarFranja($nombreFranja, $dia) {
        $cont = new data_controladorFranjas();
        return $cont->registrarFranja($nombreFranja, $dia);
    }

    function retornarFranja($nombreFranja) {
        $cont = new data_controladorFranjas();

        $result = $cont->retornarFranja($nombreFranja);
        $obj = $result->fetch_assoc();

        $objFranja = new obj_franja($obj['nombre'], $obj['id'], $obj['activo']);

        return $objFranja;
    }

    function retornarFranjas() {

        $cont = new data_controladorFranjas();
        $result = $cont->retornarFranjas();
        $array = array();

        while ($obj = $result->fetch_assoc()) {
            $array[] = new obj_franja($obj['nombre'], $obj['id'], $obj['activo']);
        }

        return $array;
    }

    function retornarFranjasActivas() {

        $cont = new data_controladorFranjas();
        $result = $cont->retornarFranjasActivas();
        $array = array();

        while ($obj = $result->fetch_assoc()) {
            $array[] = new obj_franja($obj['nombre'], $obj['id'], $obj['activo']);
        }

        return $array;
    }

    function gestionarFranja($franjaGest, $valor) {

        $cont = new data_controladorFranjas();
        return $cont->gestionarFranja($franjaGest, $valor);
    }

    /*     * ********************************************************************************************************  CURSOS

      Operaciones con  cursos

      /************************ */

    function insertarCurso($nombreCurso, $nivelCurso) {

        $cont = new data_controladorCursos();
        return $cont->registrarCurso($nombreCurso, $nivelCurso);
    }

    function retornarCursos() {
        $cont = new data_controladorCursos();
        $result = $cont->retornarCursos();
        $array = array();

        while ($obj = $result->fetch_assoc()) {
            $array[] = new obj_curso($obj['id'], $obj['nombre'], $obj['activo'], $obj['nivel']);
        }

        return $array;
    }

    function retornarCurso($nombreCurso) {

        $cont = new data_controladorCursos();
        $result = $cont->retornarCurso($nombreCurso);
        $obj = $result->fetch_assoc();

        $objCurso = new obj_curso($obj['id'], $obj['nombre'], $obj['activo'], $obj['nivel']);

        return $objCurso;
    }

    function retornarCursosActivos() {

        $cont = new data_controladorCursos();
        $result = $cont->retornarCursosActivos();
        $array = array();

        while ($obj = $result->fetch_assoc()) {
            $array[] = new obj_curso($obj['ide'], $obj['nombre'], $obj['activo'], $obj['nivel']);
        }

        return $array;
    }

    function gestionarCurso($cursoGest, $valor) {
        $cont = new data_controladorCursos();
        return $cont->gestionarCurso($cursoGest, $valor);
    }

    /*     * ******************************************************************************************************** GRUPOS

      Operaciones con  grupos

      /************************ */

    function registrarGrupo($ideGrupo, $idSede, $idCurso, $idFranja) {

        $cont = new data_controladorGrupos();

        return $cont->registrarGrupo($ideGrupo, $idSede, $idCurso, $idFranja);
    }

    function retornarGrupos() {
        $cont = new data_controladorGrupos();
        $result = $cont->retornarGrupos();
        $array = array();

        while ($obj = $result->fetch_assoc()) {

            $array[] = new obj_grupo($obj['ideGrupo'], $obj['idCurso'], $obj['idSede'], $obj['idFranja'], $obj['activo']);
        }

        return $array;
    }

    function retornarGruposConIDCurso($idCurso){

        $cont = new data_controladorGrupos();
        $result = $cont->retornarGruposConIDCurso($idCurso);
        $array = array();

        while ($obj = $result->fetch_assoc()) {

            $array[] = new obj_grupo($obj['ideGrupo'], $obj['idCurso'], $obj['idSede'], $obj['idFranja'], $obj['activo']);
        }

        return $array;   
    }

    function gestionarGrupo($grupoGest, $valor) {
        $cont = new data_controladorGrupos();
        return $cont->gestionarGrupo($grupoGest, $valor);
    }

}

?>