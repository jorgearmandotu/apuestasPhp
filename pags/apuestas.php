<!DOCTYPE HTML>

<?php
require_once('consultas.php');

?>

<html lang="es">
      <head>
          <meta charset = "utf-8">
          <title>Apuestas</title>
          <link rel="stylesheet" href="../css/apuestas.css">
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
                         <label>Nombre: </label>
                         <input type="text" name='nombre' required maxlength='20'>
                     </li>
                     <li>
                         <label>$ valor: </label>
                         <input type="number" name="valor" required maxlength='6'>
                     </li>
                     Datos partido
                     <li>
                         <label>Fecha partido: </label>
                         <input type="date" name='fecha' required>
                     </li>
                     <li>
                         <label>Liga Torneo: </label>
                         <input list="liga" name="liga">
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
                         <select name="partidos" id="partidos">
                             <option value='seleccion'>Seleciona partido</option>
                             <option value='partido1'>partido 1</option>
                             <option value='partido2'>partido 2</option>
                             <option value='--otro--'>--otro--</option>

                             <?php
                             $listPartidos = cmbpartidos($fecha);
                             foreach($listPartidos as $v){
                                 echo('<option>'.$v.'</option>');
                             }
                             ?>

                         </select>
                         <div id="divPartidos">
                             <ul>
                                 <li><label>Equipo A: </label>
                                     <input list="equipos" name="equipoA">
                                     <datalist id="equipos">
                                         <option value="equipo1">equipo 1</option>
                                     </datalist>
                                 </li>
                             
                                 <li><label>Equipo B: </label>
                                     <input list="equipos" name="equipoB">
                                     <datalist id="equipos">
                                         <option value="equipo2">equipo2</option>
                                     </datalist>
                                 </li>
                                 <li><label>HORA: </label><input type="time" name="hora"> </li>
                             </ul>
                         </div>
                     </li>
                     <li>
                         <label>Equipo apuesta: </label>
                         <select name="equipoApostado" id="equipoApostado">
                            <option value="seleccion">selecciona equipo</option>
                             <option value="equipoA">equipoA</option>
                             <option value="equipoB">equipo B</option>
                         </select>
                     </li>
                 </ul>
                 <div id="inputs">
                      <input type='text' name='partido' id="partidoselecionado" class="inputs">

                     <input type="text" name='equipoapuesta' id="equipoapuesta" class="inputs">
                 </div>
                 <button type=submit name="enviar" id="enviar">Aceppartidosetar</button>
             </form> 
          </center>
      </body>
      <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
      <script src="../js/apuestas.js"></script>
      
</html>