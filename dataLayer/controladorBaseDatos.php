<?php

include('data_controladorSedes.php');
include('data_controladorFranjas.php');
include('data_controladorCursos.php');
include('data_controladorGrupos.php');
include('data_controladorProfesores.php');
include('data_controladorUsuarios.php');
include('data_controladorPreferencias.php');
include('data_controladorHistoricoNotas.php');
include('data_controladorAsignacion.php');
include('data_controladorProcesosAsignacion.php');
include('data_controladorResultadoProcAsignacion.php');

class controladorBaseDatos {

    public function __construct() {
        
    }

    /********************************************************************************************************** USUARIOS/LOGIN
    
    Operaciones con  Usuarios / Login

    /*************************/

    function retornarUsuario($usuario,$contrasena,$tipoUsuario){
        $cont = new data_controladorUsuarios();
        if (strcmp($tipoUsuario, 'Profesor')==0){
            $result = $cont-> retornarUsuarioProf($usuario,$contrasena);
        } else {
            $result = $cont-> retornarUsuarioAdm($usuario,$contrasena);
        }

        $array = array();

        while ($obj = $result->fetch_assoc()) {
            $newUs =  new obj_usuario($obj['tipoUsuario'],$obj['usuario'],$obj['contrasena']); 
            $array[] = $newUs;
        }
        return $array;  
    }

    function registrarUsuario($usuario, $contrasena, $tipoUsuario){
        $cont = new data_controladorUsuarios();
        return $cont->registrarUsuario($usuario, $contrasena, $tipoUsuario);
    }

    function actualizarContrasena($passwd,$emailOri){
        $cont = new data_controladorUsuarios();
        return $cont->actualizarContrasena($passwd,$emailOri);
    }

    function actualizarUsuario($email,$emailOri){
        $cont = new data_controladorUsuarios();
        return $cont->actualizarUsuario($email,$emailOri);
    }

    /*

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

    function actualizarProfesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion,$emailViejo){

        $cont = new data_controladorProfesores();
        return $cont->actualizarProfesor($tipoProfesor, $departamentoEscuela, $gradoAcademicoProfesor, $cedula, $nom, $ap1, $ap2, $email, $tel, $cel, $jor, $direccion,$emailViejo);
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

    function retornarTodosLosProfesores() {
        $cont = new data_controladorProfesores();
        $result = $cont->retornarTodosLosProfesores();
        $array = array();

        while ($obj = $result->fetch_assoc()) {            
            $newProf = new obj_profesor($obj['tipoProfesor'], $obj['departamentoEscuela'], $obj['gradoAcademicoProfesor'], $obj['cedula'], $obj['nombre'], $obj['apellido1'], $obj['apellido2'], $obj['email'], $obj['telefono'], $obj['celular'], $obj['jornada'], $obj['direccion'], $obj['nivel']);
            $newProf->setActivo($obj['activo']);
            $array[] = $newProf;
        }

        return $array;
    }
    
    function retornarProfesor($emailProfesor) {
        $cont = new data_controladorProfesores();
        $result = $cont->retornarProfesor($emailProfesor);        
        $array = array();
        while ($obj = $result->fetch_assoc()) {
            $newProf = new obj_profesor($obj['tipoProfesor'], $obj['departamentoEscuela'], $obj['gradoAcademicoProfesor'], $obj['cedula'], $obj['nombre'], $obj['apellido1'], $obj['apellido2'], $obj['email'], $obj['telefono'], $obj['celular'], $obj['jornada'], $obj['direccion'], $obj['nivel']);
            $newProf->setActivo($obj['activo']);
            $newProf->setIdProfesor($obj['id']);
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

    function insertarFranja($nombreFranja) {
        $cont = new data_controladorFranjas();
        return $cont->registrarFranja($nombreFranja);
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

    function retornarGruposActivos(){
        $cont = new data_controladorGrupos();
        $result = $cont->retornarGruposActivos();
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

    /*     * ******************************************************************************************************** GRUPOS

      Operaciones con  Preferencias

      /************************ */

    function registrarPreferencia($email,$grupo,$nivel){

        $cont = new data_controladorPreferencias();
        $encontrado = 0;
        $result = $cont->retornarPreferenciasProfesor($email);

        while ($obj = $result->fetch_assoc()) {

            if (($grupo == $obj['ideGrupo'])&& ($nivel == $obj['nivel'])) {
                 $encontrado = 1; //1 significa que ya existe esa preferencia con ese grado
            }
            
        }

        if ($encontrado == 0) { //no existe preferencia para ese grupo

            //ahora vemos si la cantidad de A no es mayor a 4
            $cantidadA = $this->cantidadA($email);

            if ($cantidadA <= 4) {
                return $cont->registrarPreferencia($email,$grupo,$nivel);    
            }else{
                return 3; //3 sería ya sobrepaso el limite de preferencias
            }  

            
        }else{
            return $encontrado;
        }
        
        
    }

    function eliminarPreferencia($ideGrupo,$email,$rank){
        
        $cont = new data_controladorPreferencias();
        return $cont->eliminarPreferencia($ideGrupo,$email,$rank);
        
    }

    function cantidadA($email){

        $cont = new data_controladorPreferencias();
        return $cont->cantidadA($email);
    }

    function cantidadBC($email){

        $cont = new data_controladorPreferencias();
        $result = $this->retornarPreferenciasProfesor($email);//sacamos el total de preferencias

        $cantidadA =$this->cantidadA($email); //sacamos las cantidad de tipo A

        $cantidadBC = count($result); //obtenemos el total
        //echo "Cantidad A ".$cantidadA;
        //echo "Cantidad BC ".$cantidadBC;
        //echo "Cantidad B C final:   ". $cantidadBC;

        $cantidadBC = $cantidadBC - $cantidadA; //hacemos la resta de las totales menos las A

        if ($cantidadBC < 0) { //por si solo tenemos A
            $cantidadBC = 0;
        }

        return $cantidadBC;
    }

    function retornarPreferenciasProfesor($email){

        $cont = new data_controladorPreferencias();
        $result = $cont->retornarPreferenciasProfesor($email);
        $array = array();

        while ($obj = $result->fetch_assoc()) {

            $array[] = new obj_preferenciaDetallada($obj['email'], $obj['nivel'], $obj['ideGrupo'],$obj['nombreCurso'],$obj['franja']);
        }

        return $array; 

    }

    function gestionarPreferencias($email,$valor){
        $cont = new data_controladorPreferencias();
        $result = $cont->gestionarPreferencias($email,$valor);
    }

    /********************************************************************************************************** PROCESO DE ASIGNACION

      Operaciones con  PROCESOS DE ASIGNACIONES

      /************************ */

    function registrarProcesoAsignacion($nombre) {
        $cont = new data_controladorProcesosAsignacion();

        $procesos = $cont->retornarProcesosAsignacionxNombre($nombre);
        echo $procesos;
        if ($procesos>0){
            return 1;
        }

        else{
            return $cont->registrarProcesoAsignacion($nombre);
        }        
        
    }

    function activarProcesosAsignacion($nombre,$activo) {
        $cont = new data_controladorProcesosAsignacion();
        return $cont->activarProcesosAsignacion($nombre,$activo);
    }

    function ejecutarProcesosAsignacion($nombre,$ejecutar) {
        $cont = new data_controladorProcesosAsignacion();
        return $cont->ejecutarProcesosAsignacion($nombre,$ejecutar);
    }

    function retornarProcesosAsignacion() {
        $cont = new data_controladorProcesosAsignacion();
        $result = $cont->retornarProcesosAsignacion();
        $array = array();
        while ($obj = $result->fetch_assoc()){
            $newProcAsig = new obj_procesoAsignacion($obj['idProcesoAsignacion'], $obj['nombre'], $obj['activo'], $obj['ejecutado']);
            $array[] = $newProcAsig;
        }
        return $array;
    }

    function retornarProcesosAsignacionActivos() {
        $cont = new data_controladorProcesosAsignacion();
        $result = $cont->retornarProcesosAsignacionActivos();
        $array = array();
        while ($obj = $result->fetch_assoc()){
            $newProcAsig = new obj_procesoAsignacion($obj['idProcesoAsignacion'], $obj['nombre'], $obj['activo'], $obj['ejecutado']);
            $array[] = $newProcAsig;
        }
        return $array;

    }

    /********************************************************************************************************** RESULTADO DE ASIGNACION

      Operaciones con  RESULTADO DE ASIGNACIONES

      /************************ */ 


    function registrarResultadoProcAsignacion($idProcesoAsignacion, $ideGrupo, $email) {
        $cont = new data_controladorResultadoProcAsignacion();
        return $cont->registrarResultadoProcAsignacion($idProcesoAsignacion, $ideGrupo, $email);
    }

    function eliminarResultadoProcAsignacion($idProcesoAsignacion) {
        $cont = new data_controladorResultadoProcAsignacion();
        return $cont->eliminarResultadoProcAsignacion($idProcesoAsignacion);
    }


    function retornarResultadoProcAsignacion($idProcesoAsignacion){
        $cont = new data_controladorResultadoProcAsignacion();
        $result = $cont->retornarResultadoProcAsignacion($idProcesoAsignacion);
        $array = array();
        while ($obj = $result->fetch_assoc()){
            $newResProcAsig = new obj_resultadoProcAsignacion($obj['proceso'], $obj['sede'], $obj['curso'], $obj['ideGrupo'], $obj['franja'], $obj['profesor']);
            $array[] = $newResProcAsig;
        }
        return $array;
    }    
    
    /*     * ******************************************************************************************************** HISTORICO NOTAS

      Operaciones con  HISTORICO NOTAS

      /************************ */
    
    function registrarNota($idProfesor, $periodo, $nota, $anular) {
        $cont = new data_controladorHistoricoNotas();
        return $cont->registrarNota($idProfesor, $periodo, $nota, $anular);
    }    
    
    function retornarNotas($idProfesor) {
        $cont = new data_controladorHistoricoNotas();
        $result = $cont->retornarNotas($idProfesor);
        $array = array();
        while ($obj = $result->fetch_assoc()){
            $newNota = new obj_nota($obj['idProfesor'], $obj['periodo'], $obj['nota'], $obj['anular']);
            $array[] = $newNota;
        }
        return $array;
    }
    
    function anularNota($idProfesor, $tiempo, $modalidad, $periodoLectivo, $anular) {
        $cont = new data_controladorHistoricoNotas();
        return $cont->anularNota($idProfesor, $tiempo, $modalidad, $periodoLectivo, $anular);
    }


    /********************************************************************************************************** ASIGNACION DE NOTAS

      Operaciones con  ASIGNACION DE NOTAS

      /************************ */
      function retornarProfesoresActivosparaPreferenciasValidas($ideGrupo){
        $cont = new data_controladorAsignacion();

        $result = $cont->retornarProfesoresActivosparaPreferenciasValidas($ideGrupo);
        $array = array();

        while ($obj = $result->fetch_assoc()) {            
            $newProf = new obj_profesor($obj['tipoProfesor'], $obj['departamentoEscuela'], $obj['gradoAcademicoProfesor'], $obj['cedula'], $obj['nombre'], $obj['apellido1'], $obj['apellido2'], $obj['email'], $obj['telefono'], $obj['celular'], $obj['jornada'], $obj['direccion'], $obj['nivel']);
            $newProf->setActivo($obj['activo']);
            $array[] = $newProf;
        }

        return $array;
     }

      function preferenciasdeGrupoxProfesorxNivel($email,$ideGrupo,$nivel){

        $cont = new data_controladorAsignacion();

        $result = $cont->preferenciasdeGrupoxProfesorxNivel($email,$ideGrupo,$nivel);
        $array = array();

        while ($obj = $result->fetch_assoc()) {            
            $array[] = new obj_preferencia($obj['email'], $obj['nivel'], $obj['ideGrupo']);

        }

        return count($array);
      }


      function retornarUltimaNotaProfesor($email){

        $cont = new data_controladorAsignacion();

        $result = $cont->retornarUltimaNotaProfesor($email);
        $array = array();

        while ($obj = $result->fetch_assoc()) {            
            $newNota = new obj_nota($obj['idProfesor'], $obj['periodo'], $obj['nota'], $obj['anular']);
            $array[] = $newNota;
        }

        if (count($array) > 0) {
            return $array[0]->nota;
        }else{
            return 0;
        }

      }

      function tieneDisponibilidad($email,$ideProceso){

        $cont = new data_controladorAsignacion();

        $result = $cont->tieneDisponibilidad($email,$ideProceso);
        $cantidad = 0;


        while ($obj = $result->fetch_assoc()) {            
            $cantidad = $obj['cantidad'];
        }

        return $cantidad;
      }

      function retornarPromedioYCantidad($email){

        $cont = new data_controladorAsignacion();

        $result = $cont->retornarPromedioYCantidad($email);
        $array = array();


        while ($obj = $result->fetch_assoc()) {            
            $array[] = $obj['nota'];
            $array[] = $obj['cantidad'];
        }

        return $array;

      }

    function retornarCursosMasSolicitados() {
        
        $cont = new data_controladorReporte();  
        $result = $cont->cursosMasSolicitados();        
        $array = "";
        
        while ($obj = $result->fetch_assoc()) {
            $newReporte = new obj_reporte($obj['nombre'], $obj['nivel'], $obj['nombre'], $obj['apellido1'], 
                                          $obj['apellido2'], $obj['departamentoEscuela'], $obj['email'], $obj['nombre']);
            $array = $newReporte;
        }                
        return $array;
    }
    
    function retornarCursosMenosSolicitados() {
        $cont = new data_controladorReporte();               
        return $cont->cursosMenosSolicitados();
    }
}
?>