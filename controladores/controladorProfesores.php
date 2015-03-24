<?php

include('dataLayer/controladorBaseDatos.php');

/**
* Clase para el mantenimiento de profesores
*/
class controladorProfesores
{
	
	function __construct(){}

	function registrarProfesores($obj){

		$controlador = new controladorBaseDatos(); //llamamos al controlador de base de datos

		$nom = $obj->name;
		$ap1 = $obj->apellido1;
		$ap2 = $obj->apellido2;
		$email = $obj->email;
		$tel = $obj->tel;

        return $controlador->registrarProfesores($nom,$ap1,$ap2,$email,$tel);
	}

	function retonarProfesor($criterio,$valor){

		$criterioReal = "";

		if ($criterio == "Nombre") {
			$criterioReal = "nombre";
		}elseif ($criterio == "Primer Apellido") {
			$criterioReal = "apellido1";
		}elseif ($criterio == "Segundo Apellido") {
			$criterioReal = "apellido2";
		}else{
			$criterioReal = "email";
		}

		$controlador = new controladorBaseDatos();
		return $controlador->retonarProfesor($criterioReal,$valor);
	}

	function retornarProfesores(){

	}

	function retornarProfesor($emailProfesor){

	}

	function gestionarProfesor($emailProfesor){

	}

	function retornarProfesoresActivos(){
		//echo "  PROFESORES ACTIVOS /  ";
		$controlador = new controladorBaseDatos();
		return $controlador->retornarProfesoresActivos();

	}

}

?>
