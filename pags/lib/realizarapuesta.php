<?php
require_once '../validaciones.php';
require_once '../gestionDB.php';
validarAsesor();

$idpapuesta=$_POST['partidosids'];
$cuota =$_POST['cuotatotal'];
$valorA=$_POST['valorapostado'];
//crear la id de la pauesta fecha-hora-usuario
date_default_timezone_set('America/Bogota');
$dActual= new datetime();
$dActual= date('Y-m-d_H:i:s');
$idusuario =$_SESSION['id'];
$idApuesta=$dActual.'_U'.$idusuario;
$fecha=new datetime();
$fecha= date('Y-m-d');
$idliga=0;
echo 'es la id: '.$idApuesta.'<br>';
echo $idpapuesta.'<br>'.$cuota.'<br>'.$valorA;
$datos = explode('-idp-',$idpapuesta);
for($i=1;$i<count($datos);$i++){
   $id=explode('-apuesta-',$datos[$i]);
    $idpartido=$id[0];
    $apuestaselec=$id[1];
    $cuotaapuesta=$id[2];
    $enlace = connectionDB();
    $saldo = saldo($enlace,$idusuario);
    echo 'id:'.$idpartido.'--apuesta'.$apuestaselec.'--cuota'.$cuotaapuesta.'<br>';
   echo '<br>============================<br>'.$valora.'<br>'.$idusuario.'<br>'.$fecha.'<br>'.$idpartido.'<br>'.$apuestaselec.'<br>'.$idliga.'<br>'.$cuotaapuesta.'<br>'.$idApuesta.'<br>'.$saldo;
    if(ingresoApuesta($enlace,$valorA,$idusuario,$fecha,$idpartido,$apuestaselec,$idliga,$cuotaapuesta,$idApuesta,$saldo))
    {
        header('location: ../apuesta.php');
    }else{
        echo'<h1>OCURRIO UN ERROR AL REALISAR LA APUESTA</h1><BR>
        <a href="../apuesta.php">Volver a intentar</a>';
    }
    connectionClose($enlace);
}

?>