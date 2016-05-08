<!DOCTYPE HTML>
<?php
    require_once 'validaciones.php';
    validarAdmin();
?>
<html lang="es">
      <head>
          <meta charset = "utf-8">
          <title>actualizar cuotas</title>
          <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
          <script src="../js/cuotas.js"></script>
      </head>
      <body>
      <center>
          <ul>
              <li>
                  <label>Seleccione una fecha: </label>
                  <input type="date" name="fecha" id="fecha" <?php date_default_timezone_set('America/Lima');
                $dActual= new datetime();
                $dActual= date('Y-m-d');
                echo 'value = "'.$dActual.'"';
                ?>>
                 
<!--
                  <label>seleccione partido: </label>
                  <select name="partido" id="partidos">
                      se cargan desde php de acuerdo a la fecha
                  </select>
-->
              </li>
          </ul>
          <ul id="listpartidos">
              
          </ul>
      </center>
      <a href="administrador.php">Inicio</a>
    </body>
</html>