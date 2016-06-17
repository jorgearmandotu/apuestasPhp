<?php
require_once 'validaciones.php';
require_once 'gestionDB.php';
/*require_once 'lib/gestionApuesta.php';*/

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
             <li>
                 <label>Saldo Actual: </label><?php 
                  $enlace = connectionDB();
                  $saldo = saldo($enlace,$_SESSION['id']);
                  echo'<label>$ '.$saldo.'</label>';
                 date_default_timezone_set('America/Bogota');
                 $hora = new datetime();
                  ?>
             </li>
             <input type="hidden" id="saldo" value="<?php echo $saldo; ?>">
              <li id="selecfecha">
                  <label>Seleccione una fecha: </label>
                  <input type="date" name="fecha" id="fecha" <?php date_default_timezone_set('America/Bogota');
                $dActual= new datetime();
                $dActual= date('Y-m-d');
                echo 'value = "'.$dActual.'"';
                ?>>
                 
              </li>
              <li id="selectliga">
                  <label>seleccione liga</label>
                  <select name="liga" id="liga">
                      <option>Todas</option>
                      <?php
                      $ligas=ligas($enlace);
                      connectionClose($enlace);
                      for($i=0;$i<count($ligas);$i++){
                          echo'<option>'.$ligas[$i].'</option>';
                      }
                      ?>
                  </select>
              </li>
          </ul>
           <form method='POST' id='miniformulario' action='lib/gestionApuesta.php'>
           <div id="cantidadapuesta">
          <label>Cantidad a apostar $: </label>
             <input tipe='number' step='any' name='valorapuesta' id='valor'>
              </div>
          
      <div id="listpartidosantes">
            <div class='fila'>
                <div class='celda1' id='encabezado'>
                    <label>partido - hora </label></div>
                <div class='celda2'>
                    <label> 1 </label>
                    </div>
                <div class='celda3'>
                    <label> X </label></div>
                <div class='celda4'>
                    <label> 2 </label></div>
              </div>
              
              
                <div id="listpartidos">
                 
                 
                  
                  </div>
               </div>
            </form>
              <form method="POST" id="strform" action='lib/gestionApuesta.php'>
                  <input type="hidden" id="strapuesta" name="strapuesta">
                  <input type="hidden" id="vlrapuesta" name="vlrapuesta">
              </form>
              <div id='realizarapuestas'>
               
<!--                  <button type='button' id='apostar'>apostar</button>-->
            </div>
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