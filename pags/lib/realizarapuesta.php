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
          <link rel="stylesheet" href="../../css/printRecibo.css">
          <link rel="stylesheet" href="../../css/sweetalert.css">
       
          </head>
      <body>
      <div id='contenedor'>
          <header id="cabecera">
             <div id="logo">
                 
             </div>
                 <ul>
                     <li class="logoutico">
                       <a href="../salir.php">
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
$enlace->autocommit(false);
              
if(!ingresoApuesta($enlace,$idusuario,$fecha,$idApuesta,$valorA))
    {
        $bandera=false;
        echo'<h1>OCURRIO UN ERROR AL REALISAR LA APUESTA</h1><BR>
        <a href="../apuesta.php">Volver a intentar</a>';
    exit();
    }
              
for($i=1;$i<count($datos);$i++){
   $id=explode('-apuesta-',$datos[$i]);
    $idpartido=$id[0];
    $apuestaselec=$id[1];
    $cuotaapuesta=$id[2];
    //$idliga=idligadepartido($enlace,$idpartido);
    
   /* echo 'id:'.$idpartido.'--apuesta'.$apuestaselec.'--cuota'.$cuotaapuesta.'<br>';
   echo '<br>============================<br>'.$valorA.'<br>'.$idusuario.'<br>'.$fecha.'<br>'.$idpartido.'<br>'.$apuestaselec.'<br>'.$idliga.'<br>'.$cuotaapuesta.'<br>'.$idApuesta.'<br>'.$saldo;
   echo '<br />***********<br>este es el saldo'.$saldo.'<br /> este es el valor apostado'.$valorA.'<br />';*/
    
    if(!insertpartido_apuesta($enlace,$idpartido,$idApuesta,$apuestaselec,$cuotaapuesta)){
        $bandera=false;
        echo'<h1>OCURRIO UN ERROR AL REALISAR LA APUESTA</h1><BR><a href="../apuesta.php">Volver a intentar</a>';
        exit();
    }
    
}
if(!apuestasaldo($enlace,$saldo,$idusuario,$valorA)){
    $bandera=false;
    echo'<h1>OCURRIO UN ERROR AL REALISAR LA APUESTA</h1><BR><a href="../apuesta.php">Volver a intentar</a>';
        exit();
}


if($bandera){
    $enlace->commit();
  
  $datos = apuestass($enlace,$idApuesta);//infor general apuesta
  $partidos = idpartidosApostados($enlace,$idApuesta);//partidos de apuesta
  $punto = nompunto($enlace,$idusuario);
  $cuota = 1;
  $valora;
  $fecha='';
  for($i=0;$i<count($datos);$i++){
        
      $valora = $datos[1];//valor apostado
      $idasesor = $datos[2];//valor idasesor
      $fecha = $datos[3];//valor fecha apuesta
  }
  
  $fecha = new datetime($fecha);
  $fecha=$fecha->format('d-m-Y');
  
  ?>
  <div id= printdiv>
   <p>
     Apuesta N: <?php echo $idApuesta ?>
   </p>
    <p>
      Fecha: <?php echo $fecha ?>
    </p>
    <p>
      Punto: <?php echo $punto ?>
    </p>
    <?php
    $neventos = 0;
    for($i=0;$i<count($partidos);$i++){
        //$Npart=nompartido($enlace,$partido[$i][0]);
        
        $apos = $partidos[$i][1];//apuesta 1,2,x
        $par = equiposLigaPartido($enlace,$partidos[$i][0]);//retorna info de partido
        $equia= nomEquipo($par[0],$enlace);
        $equib= nomEquipo($par[1],$enlace);
        $Npart = $equia.' vs '.$equib;
        $Npart = utf8_decode($Npart);
        $fechapartido = $par[4];
        if($apos=='1'){
            //$apos=$par[0];
            $apos=utf8_decode($equia);
        }elseif($apos=='2'){
            //$apos=$par[1];
            $apos=utf8_decode($equib);
        }else{$apos='EMPATE';}
      echo '<pre>'.$Npart."
      ".$fechapartido."
      ".$apos."     ".$partidos[$i][2]."</pre>";
      $neventos++;
      $cuota*=$partidos[$i][2];
    
    }
    $valP=$valora*$cuota;
    $valP = number_format($valP,2,",",".");
    $valora = number_format($valora, 2, ",", ".");
  
  
  
    ?>
    <P>Eventos seleccionados: <?php echo $neventos ?></P>
    <p>Total cuota: <?php echo round($cuota,2) ?></p>
    <p>Valor Apostado: <?php echo $valora ?></p>
    <p>Valor a Pagar $: <?php echo $valP ?></p>
    
    <pre>
      Los eventos que después de iniciados sean cancelados por
      cualquier razón, ya sea por orden público, climático,
      o cualquier otro motivo, nos acogeremos a la decisión de
      la terna arbitral para la definición de cualquier tipo
      de apuesta.
      Los eventos aplazados serán considerados nulos a menos
      que sean reprogramados para ser jugados en un plazo no
      mayor a 24 horas con respecto al horario inicial del
      evento. En tales circunstancias donde un evento o eventos
      estén incluidos en una apuesta múltiple, la apuesta será
      definida en función del resto de eventos incluidos en la
      apuesta.
      Cuando una apuesta se de por anulada se le reintegrara
      el monto apostado por el apostador.
      Revise su ticket antes de salir del establecimiento,
      después no se aceptara reclamos.
    </pre>
  </div>
  
  
  <?php
  
  
    echo('<h1>Apuesta Exitosa</h1><br>
<form action=../recibo.php method="post" target="_blank">
<input hidden value='.$idApuesta.' name="idapuesta">
<button type="submit">Generar Recibo</button>
</form><br>');
 ?>
  <a alt="Imprimi Recibo" title="Imprimir Recibo" 
     href=javascript:window.print();><button>Imprimir Recibo</button></a><br><br>
<a href="../apuesta.php"><button type="button">Volver</button></a>
  <?php
  
           }else{
    $enlace->rollBack();
}
connectionClose($enlace);
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