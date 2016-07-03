<?php
require_once '../validaciones.php';
require_once '../gestionDB.php';
$cuota=null;
$cuotas=null;
validarAsesor();
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    if(isset($_POST['strapuesta'])){
        $cuotas=limpiarcadenas($_POST["strapuesta"]);
    }
    else{
        header('location: ../apuesta.php');
    }
    $valorapuesta=limpiarcadenas($_POST["vlrapuesta"]);
    $idusuario=$_SESSION['id'];
    $cuota = explode('-',$cuotas);
    $count = count($cuota);
    $cuotatotal=1;
    $totalganancia=0;
    $partidosids="";
    $enlace = connectionDB();
    $saldo=saldo($enlace,$idusuario);
    connectionClose($enlace);
        ?>
         <html lang="es">
      <head>
          <meta charset = "utf-8">
          <meta name="language" content="ES">
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta name="description" content="apuestas san juan de pasto,bookiesport,apuestas de futbol, nariño colombia apuestas"/>
        <meta name="keywords" content="sitio para hacer apuestas,bookiesport, apuestas de futbol, san juan de pasto apuestas"/>
        <meta name="author" content="Reon-Soluciones_Web"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
          <title>continuar apuesta</title>  
           <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
           <script src="../../js/gestionApuesta.js"></script>
           <link rel="stylesheet" href="../../css/normailze.min.css">
        <link rel="stylesheet" href="../../css/estilosform.css">
        <link rel="stylesheet" href="../../css/confirmapuesta.css">
           
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
          <div id="contenido">
          <div id='center'>
              <br>
             <?php
            $boton ="<button type='submit' id='submit'>confirmar apuesta</button>";
            for ($i = 0; $i < $count-1; $i++) {
            $datos = explode(':',$cuota[$i]);
                //creo cadena con idp, apuesta para utilicisacion de explode
            $partidosids.='-idp-'.$datos[1].'-apuesta-'.$datos[2].'-apuesta-'.$datos[0];
                
                //valido hora obtengo nombre de partido
                $enlace = connectionDB();
                $horapartido = fechahoraPartido($enlace,$datos[1]);
                $nompart = nompartido($enlace,$datos[1]);
                connectionClose($enlace);
                
                date_default_timezone_set("America/Bogota");
                $dActual= new datetime();
                $d = new datetime($horapartido);
                $d->modify('-1 minutes');
               if($dActual>$d){
                   echo '<label><ul><li>partido iniciado</label></li></ul>';
                   $boton='';
               }else{
                
            echo"<ul>
          <li><label>partido: ".$nompart."
           </label></li>
        <li>
            <label>apuesta: ".$datos[2]."-</label>
            <label id='cuotaspan'>cuota: ".$datos[0]."</label>
        </li>
         
          </ul>";
       
        $cuotatotal=$cuotatotal*floatval($datos[0]);
               }
                
    }
    $totalganancia=$cuotatotal*floatval($valorapuesta);
    $totalganancia=number_format($totalganancia, 1, ",", ".");
    if(floatval($saldo)>=floatval($valorapuesta) and (floatval($valorapuesta)<300001 and floatval($valorapuesta)>=5000)){
    echo "<form method='post' action='realizarapuesta.php' id='formconfirmapuesta'>
          <ul>
          <input type='hidden' value='".$partidosids."' name='partidosids'>
          <li><label>cuota total: ".$cuotatotal."</label>
              <input type='hidden' value='".$cuotatotal."' name='cuotatotal'></li>
        <li>
            <label>valor apostado: ".$valorapuesta."</label>
            <label>ganancia $: ".$totalganancia."</label>
            <input type='hidden' value='".$valorapuesta."' name='valorapostado'>

        </li>
         <li>".$boton."</li>
         <li><a href='../apuesta.php'><button type='button'>volver</button></a></li>
          </ul>
          </form>";
    }else{
        echo"<ul><li><h1>Usted No puede apostar</h1></li>
        <li>verifique que disponga de saldo suficiente o que su apuesta no sea mayor a $300000 o menor a $5000</li>
        <li><a href='../apuesta.php'><button type='button'>volver</button></a></li></ul>";
    }
}
 

?>
              </div>
          </div>
           <a target="_blank" href="../recibo.php" class="btn btn-danger">Generar Recibo</a>
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