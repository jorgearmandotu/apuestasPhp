<!DOCTYPE HTML>
<html lang="es">
      <head>
          <meta charset = "utf-8">
          <meta name="language" content="ES">
          <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
          <meta name="description" content="apuestas san juan de pasto,bookiesport,apuestas de futbol, nariño colombia apuestas"/>
          <meta name="keywords" content="sitio para hacer apuestas,bookiesport, apuestas de futbol, san juan de pasto apuestas"/>
          <meta name="author" content="Reon-Soluciones_Web"/>
          <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
          <title>Inicio sesión</title>
          <link rel="stylesheet" href="css/normailze.min.css">
          <link rel="stylesheet" href="css/login.css">
          <!--banner-->
          <script src="banner/archivos/jquery.js"></script>
          <script src="banner/archivos/amazingslider.js"></script>
          <link rel="stylesheet" type="text/css" href="banner/archivos/amazingslider-1.css">
        <script src="banner/archivos/initslider-1.js"></script>
      </head>  
      <body>
        <?php
        require_once 'pags/validaciones.php';
          validarlogeo();
        ?>
         <div id='contenedor'>
          <nav id="login">
             <div id="logo">
                 
             </div>
              <form method="post" action="pags/login.php">
                 <ul>
                     <li>
                        <label for="usuario">Usuario: </label>
                         <input type="text" name="usuario" id="usuario">
                     </li>
                     <li>
                         <label for="contrasena">Contraseña</label>
                         <input type="password" name="password" id="contrasena">
                     </li>
                     <li id="button">
                         <button type="submit">Ingresar</button>
                     </li>
                 </ul>
                  
              </form>
          </nav>
          <div id="Contenido">
              <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:1000px;margin:0px auto;">
        <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
            <ul class="amazingslider-slides" style="display:none;">
                <li><img src="banner/images/Bookiesport_stadio.png" alt="Bookiesport_stadio"  title="Bookiesport_stadio" />
                </li>
                <li><img src="banner/images/Bookiesport_jugadores.png" alt="Bookiesport_jugadores"  title="Bookiesport_jugadores" />
                </li>
                <li><img src="banner/images/Bookiesport_balones2.png" alt="Bookiesport_balones2"  title="Bookiesport_balones2" />
                </li>
            </ul>
        </div>
    </div>
          </div>
          
          <footer>
              <img src="images/Bookiesport_Logo.png">
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