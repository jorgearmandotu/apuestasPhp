<?php

require_once('gestionDB.php');
require_once('validaciones.php');
 if(!validarsession()){
            header('location: ../index.php');
        }
$enlace = connectionDB();
                  $ganador=strip_tags($_POST['equipo']);
                  $idp = $_REQUEST['partido'] ;
                  $equ = $_REQUEST['equipo'] ;
                  $equipos = equiposLigaPartido($enlace,$idp);
                  if($equipos[0]==$equ){
                      mysqli_query($enlace,"UPDATE partidos set GANADOR='1' where ID='$idp'")
                                or die("error al actualizar");
                  }if($equipos[1]==$equ){
                      mysqli_query($enlace,"UPDATE partidos set GANADOR='2' where ID='$idp'")
                                or die("error al actualizar");
                  }if("Empate"==$equ){
                      mysqli_query($enlace,"UPDATE partidos set GANADOR='X' where ID='$idp'")
                                or die("error al actualizar");
                  }
                    connectionClose($enlace);
?>