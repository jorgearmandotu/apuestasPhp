<!DOCTYPE HTML>

<?php
//require_once('consultas.php');
require_once('gestionDB.php');
?>

<html lang="es">
      <head>
          <meta charset = "utf-8">
          <title>Apuestas</title>
          <link rel="stylesheet" href="../css/apuestas.css">
      </head>  
      <body>
          <center>
             <form method="post" action="ingresoApuesta.php" id='formularioApuesta' onsubmit="return confirmar()">
                <div id="confirmarenvio">
                     <ul>
                         <li>
                             <label><strong>Nombre: </strong></label>
                             <label id="Nom"></label>
                         </li>
                         <li>
                             <label><strong>CC: </strong></label>
                             <label id="ced"></label>
                         </li>
                         <li>
                             <label><strong>Valor Apostado: </strong></label>
                             <label id="val"></label>
                         </li>
                         <li>
                             <label><strong>Fecha Partido: </strong></label>
                             <label id="fech"></label>
                         </li>
                         <li>
                         <label><strong>Partido Y hora: </strong></label>
                         <label id="part"></label>
                         </li>
                         <li>
                             <label><strong>Liga: </strong></label>
                             <label id="lig"></label>
                         </li>
                         <li>
                             <button type="submit">Aceptar</button>
                             <button type="button" id="cancelar">Cancelar</button>
                         </li>
                     </ul>
                </div>
                 <ul>
                    Datos Apostador:
                     <li>
                         <label>CC: </label>
                         <input type='text' name='cedula' required maxlength="20" id="CC">
                     </li>
                     <li>
                         <label>Nombre: </label>
                         <input type="text" name='nombre' required maxlength='20' id="nombre">
                     </li>
                     <li>
                         <label>$ valor: </label>
                         <input type="number" name="valor" required maxlength='6' id="valor">
                     </li>
                     Datos partido
                     <li>
                         <label>Fecha partido: </label>
                         <input type="date" name='fecha' required id="fecha">
                     </li>
                     
                     <li><div id="loadingPartido" >
                         <select name="partidos" id="partidos">
<!--                         se cargaran los option desde php-->
                         </select>
                         </div>
                         <div id="divPartidos">
                             <ul>
                                 <li><label>Equipo A: </label>
                                     <input list="equipos" name="equipoA" id="otroequipo1">
                                     <datalist id="equipos">
                                         <option value="equipo1">equipo 1</option>
                                     </datalist>
                                 </li>
                             
                                 <li><label>Equipo B: </label>
                                     <input list="equipos" name="equipoB" id="otroequipo2">
                                     <datalist id="equipos">
                                         <option value="equipo2">equipo2</option>
                                     </datalist>
                                 </li>
                                 <li><label>HORA: </label><input type="time" name="hora" id="hora"> </li>
                             </ul>
                         </div>
                     </li>
                     <li>
                         <label>Liga Torneo: </label>
                         <input list="liga" name="liga" id="ligaselect">
                         <datalist id="liga">
                             <!--<option value="liga1">-->
                             <?php
                             $enlace = connectionDB();
                            $listLigas = ligas($enlace);
                            connectionClose($enlace);

                           foreach($listLigas as $v){ echo('<option>'.$v.'</option>');}
                             ?>
                         </datalist>
                     </li>
                     <li>
                         <label id=equipoApuesta>Equipo apuesta: </label>
<!--                         insertar codigo php desde ajax-->
                         <select name="equipoApostado" id="equipoApostado">

                        <div id="opciones">
                            
                        </div>
                         </select>
                     </li>
                 </ul>
                 <div id="inputs">
                      <input type='text' name='partido' id="partidoselecionado" class="inputs">

                     <input type="text" name='equipoapuesta' id="equipoapuesta" class="inputs">
                 </div>
                 <button id="enviar" type="button">Enviar Apuesta</button>
             </form> 
          </center>
      </body>
      <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
      <script src="../js/apuestas.js"></script>
      
</html>