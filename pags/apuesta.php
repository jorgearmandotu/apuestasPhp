<?php
require_once 'validaciones.php';
require_once 'gestionDB.php';

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
          <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
          <script src="../js/realizarapuesta.js"></script>
          </head>
      <body>
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
          <?php
          if ($a!=null){
              echo '<h1>id partido '.$a[0][0].' cuota '.$a[0][1].'</h1>';
          }
          
          ?>
</body>
</html>