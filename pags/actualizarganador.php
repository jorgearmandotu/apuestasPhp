<!DOCTYPE HTML>
<?php
    require_once 'validaciones.php';
    validarAdmin();
?>
<html lang="es">
      <head>
          <meta charset = "utf-8">
          <meta name="language" content="ES">
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta name="description" content="apuestas san juan de pasto,bookiesport,apuestas de futbol, nariño colombia apuestas"/>
        <meta name="keywords" content="sitio para hacer apuestas,bookiesport, apuestas de futbol, san juan de pasto apuestas"/>
        <meta name="author" content="Reon-Soluciones_Web"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
          <title>agregarClientes</title>
          <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
          
        <script src="../js/modernizr-custom.js"></script>
          <script src="../js/jquery-ui.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <!--<script src="../js/funciones.js"></script>-->
            <script src="../js/ganadorr.js"></script>
            <script src="../js/ganador1.js"></script>
            
          <link rel="stylesheet" href="../css/normailze.min.css">
        <link rel="stylesheet" href="../css/estilosform.css">
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
                         <a href="administrador.php"><img src='../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
          </header>
          <div id="contenido">
          <center>
             
              <form method="post" action="actualizar.php" id="formularioganador" onsubmit="return confirmar()">
                 <ul>
                    <li>
                        <label>Fecha del partido: </label>
                        <input type="date" name='fecha' required id="fecha">
                    </li>
                    <li>
                        <label>Partido: </label>
                        <select name="partido" required id="partido">
                        
                        </select>
                    </li>
                    <li>
                        <label>Equipos: </label>
                        <select name="equipo" required id="equipo"></select>
                    </li>
                    
                     <li>
                         <button type="submit" name="Actualizar" id="btnganador">Actualizar</button>
                     </li>
                 </ul>
                 
              </form>
          </center>
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