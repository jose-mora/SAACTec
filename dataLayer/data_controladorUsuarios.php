<?php

include 'connection.php';

class data_controladorUsuarios {

    public function __construct() {}

	function retornarUsuarioProf($usuario,$contrasena){

		global $mysqli;

		$query = "SELECT 
					usuarios.tipoUsuario, usuarios.usuario, usuarios.contrasena 
				  FROM 
				  	usuarios INNER JOIN profesores ON profesores.email = usuarios.usuario 
				  WHERE 
				  	usuarios.usuario = '".$usuario."' AND usuarios.contrasena = '".$contrasena."' 
				  	AND usuarios.tipoUsuario = 'Profesor' AND profesores.activo = 1";

        $result = $mysqli->query($query);

        return $result;
    }

    function retornarUsuarioAdm($usuario,$contrasena){

		global $mysqli;

		$query = "SELECT 
					tipoUsuario, usuario, contrasena 
				  FROM 
				  	usuarios 
				  WHERE 
				  	usuario = '".$usuario."' AND contrasena = '".$contrasena."' AND tipoUsuario = 'Administrador'";

        $result = $mysqli->query($query);

        return $result;
    }

    function registrarUsuario($usuario,$contrasena,$tipoUsuario){

    	global $mysqli;

    	$query = "INSERT INTO
    				usuarios (contrasena, usuario, tipoUsuario)
    			  VALUES
    			    ('".$contrasena."','".$usuario."','".$tipoUsuario."')";

    	$mysqli->query($query);
       
        return 0;
    }

    function actualizarContrasena($passwd,$emailOri){

        global $mysqli;

        $query = "UPDATE
                    usuarios
                  SET
                    contrasena = '".$passwd."'
                  WHERE
                    usuario = '".$emailOri."'";

        $mysqli->query($query);
       
        return 0;
    }

    function actualizarUsuario($email,$emailOri){

        global $mysqli;

        $query = "UPDATE
                    usuarios
                  SET
                    usuario = '".$email."'
                  WHERE
                    usuario = '".$emailOri."'";

        $mysqli->query($query);
       
        return 0;
    }
}

?>