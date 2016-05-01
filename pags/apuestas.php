<!DOCTYPE HTML>

<?php
//require_once('consultas.php');
require_once('gestionDB.php');
require_once 'validaciones.php';
    validarAsesor();
?>

<html lang="es">
      <head>
          <meta charset = "utf-8">
          <title>Apuestas</title>
          <link rel="stylesheet" href="../css/apuestas.css">
      </head>  
      <body>
          <center>
              <label><strong>Saldo Disponible: </strong><stron><?php  
                  $enlace = connectionDB();
                  $saldoA = saldo($enlace,$_SESSION['id']);
                  echo "<strong>$ ".$saldoA."</strong>";
                  echo "<script>
                  var sal=".$saldoA.";
                  </script>";
                  ?></stron></strong></label>
             <form method="post" action="ingresoApuesta.php" id='formularioApuesta' onsubmit="return confirmar()">
                <div id="saldos"><!--se usa para la validacion en java script-->
                    <input type="text" id="saldo" name="saldo">
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
                        <label>Partido: </label>
                         <select name="partidos" id="partidos" required>
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
                         <input list="liga" name="liga" id="ligaselect" required>
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
                         <select name="equipoApostado" id="equipoApostado" required>

                        <div id="opciones">
                            
                        </div>
                         </select>
                     </li>
                 </ul>
                 <div id="inputs">
                      <input type='text' name='partido' id="partidoselecionado" class="inputs">

                     <input type="text" name='equipoapuesta' id="equipoapuesta" class="inputs">
                 </div>
                 <button id="enviar" type="submit">Enviar Apuesta</button>
             </form> 
          </center>
      </body>
      <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
      <script src="../js/apuestas.js"></script>
      
</html>