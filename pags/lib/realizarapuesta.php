<?php
require_once '../validaciones.php';
require_once '../gestionDB.php';
validarAsesor();

$idpapuesta=$_POST['partidosids'];
$cuota =$_POST['cuotatotal'];
$valorA=$_POST['valorapostado'];
//crear la id de la pauesta fecha-hora-usuario
date_default_timezone_set('America/Lima');
$dActual= new datetime();
$dActual= date('Y-m-d_H:i:s');
$idusuario =$_SESSION['id'];
$idApuesta=$dActual.'_U'.$idusuario;
$fecha=new datetime();
$fecha= date('Y-m-d');
echo 'es la id: '.$idApuesta.'<br>';
echo $idpapuesta.'<br>'.$cuota.'<br>'.$valorA;
$datos = explode('-idp-',$idpapuesta);
for($i=0;$i<count($datos);$i++){
   $id=explode('-apuesta-',$datos[$i]);
    $idpartido=$id[0];
    $apost=$id[1];
    $cuota=$id[2];
    $enlace = connectionDB();
    
}

?>