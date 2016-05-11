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
          <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
          <script src="../js/realizarapuesta.js"></script>
          <link rel="stylesheet" href="../css/normailze.min.css">
          <link rel="stylesheet" href="../css/apuesta.css">
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
            
<!--
             <div class='fila'>
            <form method='POST' id='miniformulario' action='lib/gestionApuesta.php'>
        <div class='celda1'>
        <input type='hidden' name='id' value='".$idP."' class='ids'>
         <label>".$nomEquiA."_vs_".$nomEquiB." - ".$hora." </label>
        </div>
        <div class='celda2'>
            <input type='checkbox' class='cuotas' value='".$local."' name='cuota1' id='btn'>".$local."</input>
            </form>
       
       </div>
       <div class='celda3'>
       <form method='POST' id='miniformulario' action='lib/gestionApuesta.php'>
       <input type='hidden' name='id' value='".$idP."' class='ids'>
        <input type='hidden' name='cuota' value='".$empate."' class='cuota'>
            <input type='checkbox' class='cuotas' value='".$empate."' name='cuotax'>".$empate."</input>
            </form>
        </div>
        
        <div class='celda4'>
         <form method='POST' id='miniformulario' action='lib/gestionApuesta.php'>
       <input type='hidden' name='id' value='".$idP."' class='ids'>
        <input type='hidden' name='cuota' value='".$visitante."' class='cuota'>
        <input type='checkbox' class='cuotas' value='".$visitante."'  name='cuota2'>".$visitante."</input>
        </form>
        </div>
        
        
              </div>
-->
         
          </div>
          <div >
              <p id='datosapuesta'>
                  
              </p>
          </div>
          
</body>
</html>