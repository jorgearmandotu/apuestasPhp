<?php
require_once '../gestionDB.php';
require_once('../validaciones.php');
              validarAdmin();
$idp=limpiarcadenas($_POST['id']);
$local=limpiarcadenas($_POST['cuota1']);
$visitante=limpiarcadenas($_POST['cuota2']);
$empate=limpiarcadenas($_POST['cuotax']);

echo($idp." ".$local." ".$visitante." ".$empate);
$enlace=connectionDB();
if(actualizarcuotas($enlace,$idp,$local,$visitante,$empate)){
    echo '<script type="text/javascript">alert("cuotas actualizadas")</script>';
    header('location: ../actualizarcuotas.php');
}else{
    echo '<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>';
}
conecctionClose($enlace);
?>