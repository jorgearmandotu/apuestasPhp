<?php

require_once('gestionDB.php');
require_once('validaciones.php');
 if(!validarsession()){
            header('location: ../index.php');
        }
$enlace = connectionDB();
                  $ganador=limpiarcadenas($_POST['equipo']);
                  $idp = limpiarcadenas($_REQUEST['partido']);
                  $equ = limpiarcadenas($_REQUEST['equipo']);
                  $equipos = equiposLigaPartido($enlace,$idp);
                  if($equipos[0]==$equ){
                      mysqli_query($enlace,"UPDATE partidos set resultado='1' where idpartido='$idp'")
                                or die("error al actualizar");
                  }if($equipos[1]==$equ){
                      mysqli_query($enlace,"UPDATE partidos set resultado='2' where idpartido='$idp'")
                                or die("error al actualizar");
                  }if("Empate"==$equ){
                      mysqli_query($enlace,"UPDATE partidos set resultado='X' where idpartido='$idp'")
                                or die("error al actualizar");
                  }
                    connectionClose($enlace);
?>