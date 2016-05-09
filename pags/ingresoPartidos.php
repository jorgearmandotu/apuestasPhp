<!DOCTYPE HTML>
    <?php
    require_once 'validaciones.php';
require_once 'gestionDB.php';
    validarAdmin();
    ?>


<html lang="=es">
   <head>
       <meta charset="utf-8">
       <meta name="language" content="ES">
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta name="description" content="apuestas san juan de pasto,bookiesport,apuestas de futbol, nariño colombia apuestas"/>
        <meta name="keywords" content="sitio para hacer apuestas,bookiesport, apuestas de futbol, san juan de pasto apuestas"/>
        <meta name="author" content="Reon-Soluciones_Web"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
       <title>ingresar partidos</title>
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
        <form method="post" action="lib/ingresarPartido.php" id="formularioPartido">
            <ul>
                <li>
                    <label>Equipo local: </label>
                    <input type="text" name="equipoA" required maxlength="29">
                </li>
                <li>
                    <label>Eqipo visitante: </label>
                    <input type="text" name="equipoB" required maxlength="29">
                </li>
                <li>
                    <label>liga: </label>
                    <select name="liga" id=liga>
<!--                        se cargan con php-->
                       <?php
                             $enlace = connectionDB();
                            $listLigas = ligas($enlace);
                            connectionClose($enlace);

                           foreach($listLigas as $v){ echo('<option>'.$v.'</option>');}
                        ?>
                    </select>
                </li>
                <li>
                    <label>Fecha partido: </label>
                    <input type="date" name="fecha" required>
                    <label>    Hora: </label>
                    <input type="time" name="hora" required>
                </li>
                CUOTAS:
                <li>
                    <label>Cuota local (1)</label>
                    <input type="number" step="any" required maxlength="4" name="cuota1" min="0">
                </li>
                <li>
                    <label>Cuota visitante (2)</label>
                    <input type="number" step="any" required max="4" name="cuota2" min="0">
                </li>
                <li>
                    <label>Cuota empate (X)</label>
                    <input type="number" step="any" required maxlength="4" name="cuotaX" min="0">
                </li>
                <li>
                    <button type="submit" id="enviar">AGREGAR</button> 
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
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="../js/funciones.js"></script>
</html>