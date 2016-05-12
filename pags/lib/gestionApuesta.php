<?php
require_once '../validaciones.php';
require_once '../gestionDB.php';
$cuota=null;
validarAsesor();
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $cuota=$_POST["cuota"];
    $valorapuesta=$_POST["valorapuesta"];
    $idusuario=$_SESSION['id'];
    $count = count($cuota);
    $cuotatotal=1;
    $totalganancia=0;
    $partidosids="";
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
           <link rel="stylesheet" href="../../css/normailze.min.css">
        <link rel="stylesheet" href="../../css/estilosform.css">
           
             </head>
             <body>
      <div id='contenedor'>
          <header id="cabecera">
             <div id="logo">
                 
             </div>
                 <ul id="cabecera">
                     <li class="logoutico">
                       <a href="salir.php">
                           <img src="../../images/Bookiesport_Usuario.png" alt="usuario"></a>
                     </li>
                     <li class="logout">
                         <a href="salir.php">Salir</a>
                     </li>
                     <li id="salirico">
                         <a href="asesor.php"><img src='../../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
          </header>
          <div id="contenido">
          <div id='center'>
             <?php
            for ($i = 0; $i < $count; $i++) {
//        echo $cuota[$i];
            $datos = explode(':',$cuota[$i],3);
            $partidosids.='-idp-'.$datos[1].'-apuesta-'.$datos[2].'-apuesta-'.$datos[0];
                
                //obtengo nombre de partido
                $enlace = connectionDB();
                $nompart = nompartido($enlace,$datos[1]);
                connectionClose($enlace);
                
                
            echo"<ul>
          <li><label>partido: ".$nompart."
           </label>
        <li>
            <label>apuesta: ".$datos[2]."</label>
            <label id='cuotaspan'>cuota: ".$datos[0]."</label>
        </li>
         
          </ul>";
        
        $cuotatotal=$cuotatotal*floatval($datos[0]);
    }
    $totalganancia=$cuotatotal*floatval($valorapuesta);
    
    echo "<form method='post' action='realizarapuesta.php' id='formconfirmapuesta'>
          <ul>
          <input type='hidden' value='".$partidosids."' name='partidosids'>
          <li><label>cuota total: ".$cuotatotal."</label>
              <input type='hidden' value='".$cuotatotal."' name='cuotatotal'></li>
        <li>
            <label>ganancia: ".$totalganancia."</label>
            <input type='hidden' value='".$valorapuesta."' name='valorapostado'>

        </li>
         <li><button type='submit'>confirmar apuesta</button></li>
          </ul>
          </form>";
    
}

?>
              </div>
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