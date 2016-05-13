<?php

require_once('gestionDB.php');
require_once('validaciones.php');
 if(!validarsession()){
            header('location: ../index.php');
        }
$idp = $_REQUEST['idpartido'];

$arr = array();
$ganador=strip_tags($_POST['equipo']);
$enlace = connectionDB();
$arr=equiposLigaPartido($enlace,$idp);

mysqli_query($enlace,"UPDATE partidos set GANADOR='$ganador' where ID='$idp'")
            or die("error al actualizar");
connectionClose($enlace);
?>