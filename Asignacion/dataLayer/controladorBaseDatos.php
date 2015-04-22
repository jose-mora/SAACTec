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

    function registrarProfesores($nom, $ap1, $ap2, $email, $tel) {

        $profs = $this->retornarProfesor($email);
        $nombre = "";
        while ($obj = $profs->fetch_assoc()) {
            $nombre = $obj['nombre'];
        }


        /* if ($nombre != "") {
          return 1;
          }else{
          $cont = new data_controladorProfesores();
          return 0;//$cont-> registrarProfesores($nom,$ap1,$ap2,$email,$tel);
          } */

        return 0;
    }

    function actualizarProfesor($nom, $ap1, $ap2, $email, $tel) {

        $cont = new data_controladorProfesores();
        return 0; //$cont->actualizarProfesor($nom,$ap1,$ap2,$email,$tel);
    }

    function retonarProfesor($criterio, $valor) {
        $cont = new data_controladorProfesores();
        //$result = $cont-> retonarProfesor($criterio,$valor);

        $array = array();

        /* while ($obj = $result->fetch_assoc()) {
          $newProf =  new obj_profesor($obj['id'],$obj['nombre'],$obj['apellido1'],$obj['apellido2'],$obj['email'],$obj['telefono']);
          $newProf->setActivo($obj['activo']);
          $array[] = $newProf;
          } */

        $newProf1 = new obj_profesor('1', 'Jesus', 'Mora', 'Garcia', 'test1@gmail.com', '2232-2020');
        $newProf2 = new obj_profesor('2', 'Karen', 'Valverde', 'Brenes', 'test2@gmail.com', '4244-3220');
        $newProf3 = new obj_profesor('3', 'Enrique', 'Masis', 'Gonzales', 'test3@gmail.com', '8843-6578');

        //$newProf2 =  new obj_profesor($obj['id'],$obj['nombre'],$obj['apellido1'],$obj['apellido2'],$obj['email'],$obj['telefono']);
        //$newProf3 =  new obj_profesor($obj['id'],$obj['nombre'],$obj['apellido1'],$obj['apellido2'],$obj['email'],$obj['telefono']);
        //$newProf3 =  new obj_profesor($obj['id'],$obj['nombre'],$obj['apellido1'],$obj['apellido2'],$obj['email'],$obj['telefono']);

        $array[] = $newProf1;
        $array[] = $newProf2;
        $array[] = $newProf3;

        return $array;
    }

    function retornarProfesores() {
        $cont = new data_controladorProfesores();
        return 0; //$cont-> retornarProfesores();
    }

    function retornarProfesor($emailProfesor) {
        $cont = new data_controladorProfesores();
        //$result =  $cont-> retornarProfesor($emailProfesor);
        //$array = array();
        $newProf1 = new obj_profesor('1', 'Jesus', 'Mora', 'Garcia', 'test1@gmail.com', '2232-2020');

        return $newProf1;
        /* while ($obj = $result->fetch_assoc()) {
          $newProf =  new obj_profesor($obj['id'],$obj['nombre'],$obj['apellido1'],$obj['apellido2'],$obj['email'],$obj['telefono']);
          $newProf->setActivo($obj['activo']);
          $array[] = $newProf;
          }

          if (count($array) > 0) {
          return $array[0];
          }else{
          return null;
          } */
    }

    function gestionarProfesor($emailProfesor, $valor) {
        $cont = new data_controladorProfesores();
        return 0; // $cont-> gestionarProfesor($emailProfesor,$valor);
    }

    function actualizarEvaluacion($emailProfesor, $evaluacion) {
        $cont = new data_controladorProfesores();
        return 0; //$cont-> actualizarEvaluacion($emailProfesor,$evaluacion);
    }

    function retornarProfesoresActivos() {

        //echo "BASE DE DATOS /  ";
        $cont = new data_controladorProfesores();
        //$result =  $cont-> retornarProfesoresActivos();
        $array = array();

        $newProf1 = new obj_profesor('1', 'Jesus', 'Mora', 'Garcia', 'test1@gmail.com', '2232-2020');
        $newProf2 = new obj_profesor('2', 'Karen', 'Valverde', 'Brenes', 'test2@gmail.com', '4244-3220');
        $newProf3 = new obj_profesor('3', 'Enrique', 'Masis', 'Gonzales', 'test3@gmail.com', '8843-6578');

        /* while ($obj = $result->fetch_assoc()) {
          $array[] = new obj_profesor($obj['id'],$obj['nombre'],$obj['apellido1'],$obj['apellido2'],$obj['email'],$obj['telefono']);
          } */

        $array[] = $newProf1;
        $array[] = $newProf2;
        $array[] = $newProf3;

        return $array;
    }

    /*     * ************************************************************************************************** SEDES

      Operaciones con  sedes

      /************************ */

    function insertarSede($nombreSede) {
        $cont = new data_controladorSedes();
        $cont->registrarSede($nombreSede);
    }

    function retornarSedes() {
        
        $cont = new data_controladorSedes();
        $result = $cont->retornarSedes();
        $array = array();

        while ($obj = $result->fetch_assoc()){
            $array[] = new obj_sede($obj['idsede'], $obj['nombresede'], $obj['activo']);
        }
        
        return $array;
    }

    function eliminarSede($sedeElim) {

        $cont = new data_controladorSedes();
        $cont->eliminarSede($sedeElim);
    }

    function retornarSede($nombreSede) {

        $cont = new data_controladorSedes();
        $cont->retornarSede($nombreSede);
        $obj = $result->fetch_assoc();
        $objSede = new obj_sede($obj['idsede'], $obj['nombresede'], $obj['activo'], 
                                $obj['creadopor'], $obj['modificadopor'], $obj['fechacreacion'], 
                                $obj['fechamodificacion']);

        return $objSede;
    }

    function retornarSedesActivas() {

        $cont = new data_controladorSedes();
        $array = array();

        $result = $cont->retornarSedesActivas();

        while ($obj = $result->fetch_assoc()) {
            $array[] = new obj_sede($obj['idsede'], $obj['nombresede'], $obj['activo'], 
                                    $obj['creadopor'], $obj['modificadopor'], $obj['fechacreacion'], 
                                    $obj['fechamodificacion']);
        }

        return $array;
    }

    function gestionarSedes($sedeGest, $valor) {
        $cont = new data_controladorSedes();
        $cont->gestionarSedes($sedeGest,$valor);   
    }

    /*     * ******************************************************************************************************** FRANJAS

      Operaciones con  franjas

      /************************ */

    function insertarFranja($nombreFranja) {
        $cont = new data_controladorFranjas();
        return 0; // $cont->registrarFranja($nombreFranja);
    }

    function retornarFranja($nombreFranja) {
        $cont = new data_controladorFranjas();

        /* $result = $cont->retornarFranja($nombreFranja);
          $obj = $result->fetch_assoc();

          $objFranja= new obj_franja($obj['nombre'],$obj['id'],$obj['activo']);
         */

        $objFranja = new obj_franja('7 am - 9 am', '1', '1');

        return $objFranja;
    }

    function retornarFranjas() {

        $cont = new data_controladorFranjas();
        //$result = $cont->retornarFranjas();
        $array = array();

        /* while ($obj = $result->fetch_assoc()) {
          $array[] = new obj_franja($obj['nombre'],$obj['id'],$obj['activo']);
          } */

        $objFranja = new obj_franja('7 am - 9 am', '1', '1');
        $objFranja2 = new obj_franja('9 am - 11 am', '1', '1');
        $objFranja3 = new obj_franja('3 pm - 5 pm', '1', '1');

        $array[] = $objFranja;
        $array[] = $objFranja2;
        $array[] = $objFranja3;

        return $array;
    }

    function retornarFranjasActivas() {

        $cont = new data_controladorFranjas();
        //$result = $cont->retornarFranjasActivas();
        $array = array();

        /* while ($obj = $result->fetch_assoc()) {
          $array[] = new obj_franja($obj['nombre'],$obj['id'],$obj['activo']);
          } */

        $objFranja = new obj_franja('7 am - 9 am', '1', '1');
        $objFranja2 = new obj_franja('9 am - 11 am', '1', '1');
        $objFranja3 = new obj_franja('3 pm - 5 pm', '1', '1');

        $array[] = $objFranja;
        $array[] = $objFranja2;
        $array[] = $objFranja3;

        return $array;
    }

    function gestionarFranja($franjaGest, $valor) {

        $cont = new data_controladorFranjas();
        return 0; //$cont->gestionarFranja($franjaGest,$valor); 
    }

    /*     * ********************************************************************************************************  CURSOS

      Operaciones con  cursos

      /************************ */

    function insertarCurso($nombreCurso) {

        $cont = new data_controladorCursos();
        return 0; // $cont->registrarCurso($nombreCurso);
    }

    function retornarCursos() {
        $cont = new data_controladorCursos();
        //$result = $cont->retornarCursos();
        $array = array();

        $objCurso1 = new obj_curso('1', 'PETI', '1');
        $objCurso2 = new obj_curso('1', 'Modelos de Desarrollo', '1');
        $objCurso3 = new obj_curso('1', 'SIA', '1');

        /* while ($obj = $result->fetch_assoc()) {
          $array[] = new obj_curso($obj['id'],$obj['nombre'],$obj['activo']);
          } */

        $array[] = $objCurso1;
        $array[] = $objCurso2;
        $array[] = $objCurso3;

        return $array;
    }

    function retornarCurso($nombreCurso) {

        $cont = new data_controladorCursos();
        //$result = $cont->retornarCurso($nombreCurso);
        //$obj = $result->fetch_assoc();

        $objCurso1 = new obj_curso('1', 'PETI', '1');
        //$objCurso= new obj_curso($obj['id'],$obj['nombre'],$obj['activo']);

        return $objCurso1;
    }

    function retornarCursosActivos() {

        $cont = new data_controladorCursos();
        //$result = $cont->retornarCursosActivos();
        $array = array();

        $objCurso1 = new obj_curso('1', 'PETI', '1');
        $objCurso2 = new obj_curso('1', 'Modelos de Desarrollo', '1');
        $objCurso3 = new obj_curso('1', 'SIA', '1');

        /* while ($obj = $result->fetch_assoc()) {
          $array[] = new obj_curso($obj['ide'],$obj['nombre'],$obj['activo']);
          } */

        $array[] = $objCurso1;
        $array[] = $objCurso2;
        $array[] = $objCurso3;

        return $array;
    }

    function gestionarCurso($cursoGest, $valor) {
        $cont = new data_controladorCursos();
        return 0; //$cont->gestionarCurso($cursoGest,$valor);
    }

    /*     * ******************************************************************************************************** GRUPOS

      Operaciones con  grupos

      /************************ */

    function registrarGrupo($ideGrupo, $idSede, $idCurso, $idFranja) {

        $cont = new data_controladorGrupos();

        return 0; //$cont->registrarGrupo($ideGrupo, $idSede, $idCurso,$idFranja);
    }

    function retornarGrupos() {
        $cont = new data_controladorGrupos();
        //$result = $cont->retornarGrupos();
        $array = array();

        $objGrupo1 = new obj_grupo('IC01C', '1', '1', '1', '1');
        $objGrupo2 = new obj_grupo('PETI02C', '2', '1', '2', '1');
        $objGrupo3 = new obj_grupo('AFI22', '3', '3', '3', '1');

        /* while ($obj = $result->fetch_assoc()) {

          $array[] = new obj_grupo($obj['ideGrupo'],$obj['idCurso'],$obj['idSede'],$obj['idFranja'],$obj['activo']);
          } */

        $array[] = $objGrupo1;
        $array[] = $objGrupo2;
        $array[] = $objGrupo3;

        return $array;
    }

    function gestionarGrupo($grupoGest, $valor) {
        $cont = new data_controladorGrupos();
        return 0; //$cont->gestionarGrupo($grupoGest,$valor);
    }

}

?>