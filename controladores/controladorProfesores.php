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
		$jor = $obj->jornada;
		$niv = $obj->nivel;

        return $controlador->registrarProfesores($nom,$ap1,$ap2,$email,$tel,$jor,$niv);
	}

	function actualizarProfesor($obj, $emailOri){

		$controlador = new controladorBaseDatos(); //llamamos al controlador de base de datos

		$emailNuevo = $obj->email;
		$nom = $obj->name;
		$ap1 = $obj->apellido1;
		$ap2 = $obj->apellido2;		
		$tel = $obj->tel;
		$jor = $obj->jornada;
		$niv = $obj->nivel;

		if ($emailOri != $emailNuevo ) { //si el email cambio debemos fijarnos si ya el nuevo esta utilizado
			echo " cambio de email";
			$profesor = $this->retornarProfesor($emailNuevo);

			if ($profesor) { //ya existe, devolvemos error
				echo " ya existe email";
				return 4;
			}else{
				return $controlador->actualizarProfesor($nom,$ap1,$ap2,$emailNuevo,$tel,$jor,$niv);
			}
		}else{
			return $controlador->actualizarProfesor($nom,$ap1,$ap2,$emailNuevo,$tel,$jor,$niv);
		}
		
		
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
		$controlador = new controladorBaseDatos();
		return $controlador->retornarProfesor($emailProfesor);
	}

	function gestionarProfesor($emailProfesor,$valor){
		$controlador = new controladorBaseDatos();
		return $controlador->gestionarProfesor($emailProfesor,$valor);
	}

	function retornarProfesoresActivos(){
		//echo "  PROFESORES ACTIVOS /  ";
		$controlador = new controladorBaseDatos();
		return $controlador->retornarProfesoresActivos();

	}

}

?>
