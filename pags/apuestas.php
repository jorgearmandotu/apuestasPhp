<!DOCTYPE HTML>
<?php
require_once('consultas.php');

?>
<html lang="es">
      <head>
          <meta charset = "utf-8">
          <title>Apuestas</title>
      </head>  
      <body>
          <center>
             <form method="post" action="ingresoApuesta.php" id='formularioApuesta'>
                 <ul>
                    Datos Apostador:
                     <li>
                         <label>CC: </label>
                         <input type='text' name='cedula' required maxlength="20">
                     </li>
                     <li>
                       st  <label>Nombre: </label>
                         <input type="text" name='nombre' required maxlength='20'>
                     </li>
                     <li>
                         <label>$ valor: </label>
                         <input type="number" name="valor" required maxlength='6'>
                     </li>
                     Datos partido
                     <li>
                         <label>Fecha partido: </label>
                         <input type="date" name='fecha' required maxlength=""
                     </li>
                     <li>
                         <label>Liga Torneo: </label>
                         <input list="liga">
                         <datalist id="liga">
                             <!--<option value="liga1">-->
                             <?php
                             $listLigas=cmbligas();
                            foreach($listLigas as $v){ echo('<option>'.$v.'</option>');}
                             ?>
                         </datalist>
                     </li>
                     <li>
                         <label>Partido: </label>
                         <select name="partidos">
                             <!--<option>partido a</option>-->
                             <?php
                             $listPartidos = cmbpartidos($fecha);
                             foreach($listPartidos as $v){
                                 echo('<option>'.$v.'</option>');
                             }
                             ?>
                         </select>
                         
                         <ul>
                             <li><label>Equipo A:</label></li>
                             <li><label>Equipo B:</label></li>
                             <li><label>HORA: </label><input type="time"> </li>
                         </ul>
                     </li>
                     <li>
                         <label>Equipo apuesta: </label>
                         <select name="equipoApostado">
                             <option>equipoA
                             </option>
                             <option>equipo B</option>
                         </select>
                     </li>
                 </ul>
             </form> 
          </center>
      </body>
      <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
</html>