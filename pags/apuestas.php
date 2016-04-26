<!DOCTYPE HTML>
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
                         <input type="date" name='fecha' required maxlength=""
                     </li>
                     <li>
                         <label>Liga Torneo: </label>
                         <ul>
                             <li><label>Nombre liga:</label></li>
                         </ul>
                     </li>
                     <li>
                         <label>Partido: </label>
                         <ul>
                             <li><label>Equipo A:</label></li>
                             <li><label>Equipo B:</label></li>
                         </ul>
                     </li>
                     <li>
                         <label>Equipo apuesta: </label>
                     </li>
                 </ul>
             </form> 
          </center>
      </body>
</html>