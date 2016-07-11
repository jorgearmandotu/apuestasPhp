<!DOCTYPE HTML>
<html lang="es">
<head>
          <meta charset = "utf-8">
          <meta name="language" content="ES">
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta name="description" content="apuestas san juan de pasto,bookiesport,apuestas de futbol, nariño colombia apuestas"/>
        <meta name="keywords" content="sitio para hacer apuestas,bookiesport, apuestas de futbol, san juan de pasto apuestas"/>
        <meta name="author" content="Reon-Soluciones_Web"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
         <title>Realizar apuestas</title>
          <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
          <link rel="stylesheet" href="../../css/normailze.min.css">
          <script src="../../js/sweetalert.min.js"></script>
           <link rel="stylesheet" href="../../css/estilosform.css">
          <link rel="stylesheet" href="../../css/apuesta.css">
          <link rel="stylesheet" href="../../css/sweetalert.css">
       
          </head>
      <body>
      <div id='contenedor'>
          <header id="cabecera">
             <div id="logo">
                 
             </div>
                 <ul>
                     <li class="logoutico">
                       <a href="salir.php">
                           <img src="../../images/Bookiesport_Usuario.png" alt="usuario"></a>
                     </li>
                     <li class="logout">
                         <a href="../salir.php">Salir</a>
                     </li>
                     <li id="salirico">
                         <a href="../asesor.php"><img src='../../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
          </header>
          <div class="centro">
<?php
require_once '../validaciones.php';
require_once '../gestionDB.php';
validarAsesor();

$idpapuesta=limpiarcadenas($_POST['partidosids']);
$cuota =limpiarcadenas($_POST['cuotatotal']);
$valorA=limpiarcadenas($_POST['valorapostado']);
//crear la id de la pauesta fecha-hora-usuario
date_default_timezone_set('America/Bogota');
$dActual= new datetime();
$dActual= date('Y-m-d_H:i:s');
$idusuario =$_SESSION['id'];
$idApuesta=$dActual.'_U'.$idusuario;
$fecha=new datetime();
$fecha= date('Y-m-d');
//$idliga=0;
//echo 'es la id: '.$idApuesta.'<br>';
//echo $idpapuesta.'<br>'.$cuota.'<br>'.$valorA;
$datos = explode('-idp-',$idpapuesta);
$enlace = connectionDB();
$saldo = saldo($enlace,$idusuario);
$bandera=true;
for($i=1;$i<count($datos);$i++){
   $id=explode('-apuesta-',$datos[$i]);
    $idpartido=$id[0];
    $apuestaselec=$id[1];
    $cuotaapuesta=$id[2];
    //$idliga=idligadepartido($enlace,$idpartido);
    
   /* echo 'id:'.$idpartido.'--apuesta'.$apuestaselec.'--cuota'.$cuotaapuesta.'<br>';
   echo '<br>============================<br>'.$valorA.'<br>'.$idusuario.'<br>'.$fecha.'<br>'.$idpartido.'<br>'.$apuestaselec.'<br>'.$idliga.'<br>'.$cuotaapuesta.'<br>'.$idApuesta.'<br>'.$saldo;
   echo '<br />***********<br>este es el saldo'.$saldo.'<br /> este es el valor apostado'.$valorA.'<br />';*/
    if(!ingresoApuesta($enlace,$valorA,$idusuario,$fecha,$idpartido,$apuestaselec,$cuotaapuesta,$idApuesta,$saldo))
    {
        $bandera=false;
        echo'<h1>OCURRIO UN ERROR AL REALISAR LA APUESTA</h1><BR>
        '.$valorA.'<br>'.$idusuario.'<br>'.$fecha.'<br>'.$idpartido.'<br>'.$apuestaselec.'<br>
        <a href="../apuesta.php">Volver a intentar</a>';
    }
    
}

connectionClose($enlace);

if($bandera){echo('<h1>Apuesta Exitosa</h1><br>
<form action=../recibo.php method="post" target="_blank">
<input hidden value='.$idApuesta.' name="idapuesta">
<button type="submit">Generar Recibo</button>
</form><br><br>
<a href="../apuesta.php"><button type="button">Volver</button></a>');
           }
?>
          </div>
  <footer>
              <img src="../../images/Bookiesport_Logo.png">
              <p>
                  BOOKIESPORT<br>
                  empresa dedicada a las apuestas
                  visitanos en 
                  tel:
                  
              </p>
          </footer>
          </div>
</body>
</html>