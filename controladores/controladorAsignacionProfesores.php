<?php
  
  include('objetos/obj_grupo.php');
  include('objetos/obj_profesor.php');
  include('objetos/obj_asignacionProfesor.php');
  include('objetos/obj_preferencia.php');
  include('objetos/obj_nota.php');

	class controladorAsignacionProfesores {

          public function __construct() {
          }

          /************************
            Algoritmo de asignación
          /*************************/

          function asignarProfesores($idProcesoAsignacion){

            $controlador = new controladorBaseDatos(); 
            $listaGrupos = $controlador->retornarGruposActivos();

            //$listaProfesores = array();//va a guardar los profesores que tienen el grupo como preferencia
            //$listaConPlaza = array();
            //$listaInterinos = array();
            
            

            foreach ($listaGrupos as $grupo){

              $listaProfesores = array();
              $listaConPlaza = array();
              $listaInterinos = array();
              $encontro = false;            

              echo "<br/> <b> ". $grupo->ideGrupo. '</b><br/>'; 

              //esto nos da la lista de profesores activos que tienen preferencias validas para ese grupo
              $listaProfesores = $controlador->retornarProfesoresActivosparaPreferenciasValidas($grupo->ideGrupo);


              //si existen profesores con esa preferencia
              if (count($listaProfesores) > 0) {
                
                
                //vamos analizando los profesores
                foreach ($listaProfesores as $profesor){

                  echo $profesor->email. ' - '.$profesor->tipoProfesor.'<br/>';

                  //vamos a verificar la disponibilidad del profesor
                  if ($this->tieneDisponibilidad($profesor->email,$profesor->jornada,$idProcesoAsignacion)){

                    //los dividimos entre con plaza e interinos
                    if (strcmp ( $profesor->tipoProfesor , "Con plaza") == 0) {
                      $listaConPlaza[] = $profesor;    
                    }else{
                      $listaInterinos[] = $profesor;    
                    }
                  }else{
                    echo "Profesor ".$profesor->email. " ya no tiene disponibilidad <br/>";
                  }
                  

                }//end del for each

                echo "Cantidad con plaza: ". count($listaConPlaza) . " / interinos ". count($listaInterinos). '<br/><br/>';


                //buscamos los de priodidad plaza en primer lugar
                $encontro = $this->busquedaXPrioridad($listaConPlaza, $grupo->ideGrupo,$idProcesoAsignacion);

                //si no encontro, entramos a verificar los interinos
                if (!$encontro) {
                  echo "No encontro con plaza, buscando con interinos <br/>";
                  $encontro = $this->busquedaXPrioridad($listaInterinos, $grupo->ideGrupo,$idProcesoAsignacion);  

                }

                if ($encontro) {
                  echo "<br/> <b> TENEMOS PROFESOR ASIGNADO EN BASE DE DATOS </b> <br/>";

                }else{//no hay profesores

                  $this->noExiste($grupo); 
                }
            
            }else{ //no hay profesores

                $this->noExiste($grupo); 
            }

          }
        } 


        //-------------------------------------------------------------------------------------------------------------------------
          //*************************************************************************************************************************
          //-------------------------------------------------------------------------------------------------------------------------


          //buscar los profesores, utilizando la lista de interinos o en plaza
          //va a buscar por prioridad para el descarte
          function busquedaXPrioridad($listaProfesores, $grupo,$idProcesoAsignacion){

            $controlador = new controladorBaseDatos(); 
            $encontro = false;

            //si la lista es vacía devolvemos false de una vez
            if (count($listaProfesores) == 0) {
              return $encontro;
            }

            $listaProfesoresAceptados= array();

            //------------------------------------------------------------------------------------------------------------------------- A
            echo "Buscando con prioridad A <br/>";
            $listaProfesoresAceptados = $this->retornaProfesoresconNivel($listaProfesores, $grupo,'A');

            //si existen profesores con A de nivel de preferencia en ese grupo
            if (count($listaProfesoresAceptados)>0) {
              //si encontramos profesor

              if (count($listaProfesoresAceptados) == 1) { //solo existe un profesor, por tanto es el indicado
                  //************************************************************************************ GUARDAMOS LOS VALORES
                  echo "Solo existe un profesor aceptado con A ".$listaProfesoresAceptados[0]->email . "<br/>";

                  //guardamos en base de datos los resultados
                  $controlador->registrarResultadoProcAsignacion($idProcesoAsignacion, $grupo, $listaProfesoresAceptados[0]->email);

                  $encontro = true;
                  return $encontro;

              }else{//existen mas de 1, tenemos que ir a ver las notas
                  //llamar a ver notas de los profesores asignados
                  echo "Existe mas de 1 con A <br/>";
                  $encontro = $this->buscaProfesorConMejorNota($listaProfesoresAceptados,$grupo,$idProcesoAsignacion);
              }
            }

            
            //------------------------------------------------------------------------------------------------------------------------- B
            //verificamos si encontro o no con la A y si no vamos con B
            if (!$encontro) {
              echo "Buscando con prioridad B <br/>";
              $listaProfesoresAceptados = $this->retornaProfesoresconNivel($listaProfesores, $grupo,'B');

              if (count($listaProfesoresAceptados)>0) {
                //si encontramos profesor
                
                if (count($listaProfesoresAceptados) == 1) { //solo existe un profesor, por tanto es el indicado
                
                  echo "Solo existe un profesor aceptado con B ".$listaProfesoresAceptados[0]->email . "<br/>";

                  //guardamos en base de datos los resultados
                  $controlador->registrarResultadoProcAsignacion($idProcesoAsignacion, $grupo, $listaProfesoresAceptados[0]->email);
                  
                  $encontro = true;
                  return $encontro;

                }else{//existen mas de 1, tenemos que ir a ver las notas
                  //llamar a ver notas de los profesores asignados
                  $encontro = $this->buscaProfesorConMejorNota($listaProfesoresAceptados,$grupo,$idProcesoAsignacion);
                }
              }
            }

            //------------------------------------------------------------------------------------------------------------------------- C
            if (!$encontro) {
              echo "Buscando con prioridad C <br/>";

              $listaProfesoresAceptados = $this->retornaProfesoresconNivel($listaProfesores, $grupo,'C');

              if (count($listaProfesoresAceptados)>0) {
                //si encontramos profesor
                if (count($listaProfesoresAceptados) == 1) { //solo existe un profesor, por tanto es el indicado
                
                  echo "Solo existe un profesor aceptado con C ".$listaProfesoresAceptados[0]->email . "<br/>";
                  
                  //guardamos en base de datos los resultados
                  $controlador->registrarResultadoProcAsignacion($idProcesoAsignacion, $grupo, $listaProfesoresAceptados[0]->email);
                  

                  $encontro = true;
                  return $encontro;

                }else{//existen mas de 1, tenemos que ir a ver las notas
                  //llamar a ver notas de los profesores asignados
                  $encontro = $this->buscaProfesorConMejorNota($listaProfesoresAceptados,$grupo,$idProcesoAsignacion);
                }
              }
            }
            //-------------------------------------------------------------------------------------------------------------------------


            
            return $encontro;


          }


          //-------------------------------------------------------------------------------------------------------------------------
          //*************************************************************************************************************************
          //-------------------------------------------------------------------------------------------------------------------------

          //buscamos al profesor con la mejor nota de una lista X de profesores
          //la lista puede ser los de prioridad A, B o C
          function buscaProfesorConMejorNota($listaProfesores,$grupo,$idProcesoAsignacion){

            $listaProfesoresAsignados = array();
            $controlador = new controladorBaseDatos(); 

            $profesorMejor = new obj_asignacionProfesor();
            $mejorNota = 0;

              //recorremos los profesores
              foreach ($listaProfesores as $profesor){

                //if ($this->tieneDisponibilidad($email)) {} -->todo va envuelto en este if

                //obtenemos el mejor profesor posible
                $objeto =$this->retornaObjetoAsignacionCompleto($profesor->email);                
                $ultimaNota = $objeto->ultimaNota;

                //si no teniamos informacion anterior almacenada
                if ($mejorNota == 0) {

                  $mejorNota = $ultimaNota;//se guarda la ultima nota como la mejor
                  $profesorMejor = $objeto;//cambiamos el objeto Mejor

                }elseif ($ultimaNota >= $mejorNota) {//tenemos un profesor igual o mejor al que está como mejor
                  
                  //si la nota del profesor es mejor que la que esta asignada como mayor
                  //se reemplaza el profesor
                  if ($ultimaNota > $mejorNota) {

                    $mejorNota = $ultimaNota;//se guarda la ultima nota como la mejor
                    $profesorMejor = $objeto;//cambiamos el objeto Mejor

                  }elseif ($ultimaNota == $mejorNota) { //si son iguales tenemos que ver otros aspectos aparte de la disponibilidad
                      echo "Tienen la misma nota!! <br/>";
                      
                      //vemos si el profesor nuevo tiene mas cantidad de notas, por lo tanto tiene mayor antiguedad
                      if ($profesorMejor->cantidadNotas <= $objeto->cantidadNotas) {
                        
                          //si es menor, cambiamos por el nuevo inmediatamente
                          if ($profesorMejor->cantidadNotas < $objeto->cantidadNotas) {
                              $mejorNota = $ultimaNota;//se guarda la ultima nota como la mejor
                              $profesorMejor = $objeto;//cambiamos el objeto Mejor

                          }else{

                              //sino, hacemos la misma revisión pero con el promedio de notas
                              if ($profesorMejor->promedioNotas <= $objeto->promedioNotas) {

                                  //si el promedio del nuevo es mejor hacemos el cambio
                                  if ($profesorMejor->promedioNotas < $objeto->promedioNotas) {  

                                      $mejorNota = $ultimaNota;//se guarda la ultima nota como la mejor
                                      $profesorMejor = $objeto;//cambiamos el objeto Mejor

                                  }else{
                                      //nos quedamos con el primero que solicitamos.
                                  }                               
                              } //fin del promedio
                          }//fin del else
                      } //fin de cantidad de notas
                  }//fin de notas iguales
                }//fin del else a mejor nota
              }

              //guardamos en base de datos los resultados
              $controlador->registrarResultadoProcAsignacion($idProcesoAsignacion, $grupo, $profesorMejor->email);
                  
              echo "Tenemos el mejor profesor y es: ". $profesorMejor->email ."<br/>";

              //guardamos el resultado
              return true;
 
          }

          //-------------------------------------------------------------------------------------------------------------------------
          //*************************************************************************************************************************
          //-------------------------------------------------------------------------------------------------------------------------

          //retorna la última nota del profesor
          function retornaObjetoAsignacionCompleto($email){

            echo "<br/> Datos de: ". $email . "<br/>";
              $controlador = new controladorBaseDatos(); 
              
              //sacamos la ultima nota del profesor
              $ultimaNota= $controlador->retornarUltimaNotaProfesor($email);

              echo "La ultima nota es: ".$ultimaNota . "<br/>";
              //sacamos la info faltante del profesor
              $arrayInfoFaltante = $controlador->retornarPromedioYCantidad($email);

              echo "Cantidad de notas: ". $arrayInfoFaltante[1] ." / Promedio General: ". $arrayInfoFaltante[0] . "<br/>";

              echo "-------------------------------------------------- <br/>";
              //creamos la instancia y llenamos el objeto
              $objeto = new obj_asignacionProfesor();
              $objeto->setEmail($email);
              $objeto->setUltimaNota($ultimaNota);
              $objeto->setCantidadNotas($arrayInfoFaltante[1]);
              $objeto->setPromedioNotas($arrayInfoFaltante[0]);
              $objeto->greet();

              return $objeto;
          } 


          //-------------------------------------------------------------------------------------------------------------------------
          //*************************************************************************************************************************
          //-------------------------------------------------------------------------------------------------------------------------

          //nos dice cuantos profesores tienen preferencias de ese nivel en ese grupo
          //ya estos profesores tienen preferencia con el grupo pero no sabemos cuantos son A,B o C
          //esto nos devuelve un arreglo de los profesores que tienen la preferencia solicitada
          function retornaProfesoresconNivel($listaProfesores, $ideGrupo,$nivel){

              $listaProfesoresAceptados= array();
              $controlador = new controladorBaseDatos(); 

              //recorremos los profesores
              foreach ($listaProfesores as $profesor){

                //pedimos la cantidad de prefernecias nivel A
                $cantidad = $controlador->preferenciasdeGrupoxProfesorxNivel($profesor->email,$ideGrupo,$nivel);

                if ($cantidad > 0) {//si tiene preferencias nivel A
                  $listaProfesoresAceptados[]=$profesor;                  
                }
              }

              return $listaProfesoresAceptados;
          }

          //verifica si el profesor tiene disponibilidad
          function tieneDisponibilidad($email,$jornada,$ideProceso){

            //echo $ideProceso."<br/>";
            $controlador = new controladorBaseDatos(); 

            $cantidad = $controlador->tieneDisponibilidad($email,$ideProceso);

            if ($cantidad > 0) {

              $jornadaint = intval(substr($jornada, 0, -1));

              $totalPermitido = $jornadaint/25;

              echo "La jornada numerica es: ". $jornadaint . " y la cantidad de cursos es ".$cantidad ." el total permitido: ". $totalPermitido ."<br/>";


              if ($cantidad >= $totalPermitido) {

                 return false;

              }else{

                return true;

              }

            }else{

              return true;

            }

          }

          //-------------------------------------------------------------------------------------------------------------------------
          //*************************************************************************************************************************
          //-------------------------------------------------------------------------------------------------------------------------
          //NO EXISTE profesor optando o adecuado para ese grupo. Se debe guardar en la base de datos como grupo desierto
          function noExiste($grupo){
            echo "No hay profesor optando para el grupo ". $grupo->ideGrupo.'<br/>';
          }
          

                   
}
          
?>