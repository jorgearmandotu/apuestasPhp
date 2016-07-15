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
        <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script src="../js/modernizr-custom.js"></script>
          <script src="../js/jquery-ui.min.js"></script>
          <script src="../js/timePicker.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="../css/timePicker.css">
          <script src="../js/gestionligas.js"></script>
       <title>ingresar partidos</title>
       <link rel="stylesheet" href="../css/normailze.min.css">
        <link rel="stylesheet" href="../css/estilosform.css">
        <link rel="stylesheet" href="../css/gestionligas.css">
   </head>
    <body>
    <div id='contenedor'>
          <header id="cabecera">
             <div id="logo">
                 
             </div>
                 <ul>
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
        <form method="post" action="lib/gestionligas.php" id="ligaform">
           <fieldset>
           <legend>Ingreso Ligas</legend>
            <ul>
                <li>
                    <label for="nliga">Nombre LIga: </label>
                    <input type='text' required name="nliga" maxlength="28">
                </li>
                <li>
                    <label for="npais">Pais Liga: </label>
                    <input type="text" required name="npais" maxlength="28">
                </li>
                <li>
                    <button type="submit" id="insertliga">Agregar</button>
                </li>
            </ul>
            </fieldset>
        </form>
        <form method="post" action="lib/gestionligas.php" id="equipoform">
           <fieldset>
           <legend>Ingreso Equipos</legend>
            <ul>
                <li>
                    <label for="nequipo">Nombre Equipo: </label>
                    <input type='text' required name="nequipo" maxlength="28">
                </li>
                <li>
                  <label>pais: </label>
                  <select name="pais" id='pais' required>
                     
                      
                  </select>
              </li>
                <li>
                    <label for="ligaselec">Liga: </label>
                    <select name="ligaselec" id="listligas" required>
                        
                    </select>
                </li>
                <li>
                    <button type="submit" id="insertequipo">Agregar</button>
                </li>
            </ul>
            </fieldset>
        </form>
        <div id="respuesta"></div>
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