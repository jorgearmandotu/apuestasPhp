<?php
require_once 'validaciones.php';
require_once 'gestionDB.php';
require_once 'lib/gestionApuesta.php';

validarAsesor();
$idp=null;

$apuesta=null;

function crrearapuesta(){
    if($_POST['id']!=null){
    echo 'hola';
    $idp = $_POST['id'];
    $cuota = $_POST['cuota'];
}
}
    
?>
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
          <script src="../js/modernizr-custom.js"></script>
          <script src="../js/jquery-ui.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="../css/normailze.min.css">
          <script src="../js/realizarapuesta.js"></script>
           <link rel="stylesheet" href="../css/estilosform.css">
          <link rel="stylesheet" href="../css/apuesta.css">
          </head>
      <body>
      <div id='contenedor'>
          <header id="cabecera">
             <div id="logo">
                 
             </div>
                 <ul id="cabecera">
                     <li class="logoutico">
                       <a href="salir.php">
                           <img src="../images/Bookiesport_Usuario.png" alt="usuario"></a>
                     </li>
                     <li class="logout">
                         <a href="salir.php">Salir</a>
                     </li>
                     <li id="salirico">
                         <a href="asesor.php"><img src='../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
          </header>
          <div id="contenido">
          <div id='center'>
      <ul>
              <li id="selecfecha">
                  <label>Seleccione una fecha: </label>
                  <input type="date" name="fecha" id="fecha" <?php date_default_timezone_set('America/Lima');
                $dActual= new datetime();
                $dActual= date('Y-m-d');
                echo 'value = "'.$dActual.'"';
                ?>>
                 
              </li>
          </ul>
      <div id="listpartidos">
            

         
          </div>
          <aside id="datosapuestas">
              
              </aside>
              </div>
          </div>
              <footer>
              <img src="../images/Bookiesport_Logo.png">
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