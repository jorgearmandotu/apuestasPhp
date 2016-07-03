<!DOCTYPE HTML>
<html lang="es">
   <head>
       <meta charset="utf-8">
       <meta name="language" content="ES">
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta name="description" content="apuestas san juan de pasto,bookiesport,apuestas de futbol, nariño colombia apuestas"/>
        <meta name="keywords" content="sitio para hacer apuestas,bookiesport, apuestas de futbol, san juan de pasto apuestas"/>
        <meta name="author" content="Reon-Soluciones_Web"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
       <title>cambiarContraseña</title>
       <link rel="stylesheet" href="../css/normailze.min.css">
        <link rel="stylesheet" href="../css/estilosform.css">
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
                         <a href="asesor.php"><img src='../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
          </header>
          <div id="contenido">
    <?php
        require_once('gestionDB.php');
        require_once('validaciones.php');
         if(!validarsession()){
            header('location: ../index.php');
        }
        
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];
    ?>
    <center>
    <h2>Cambio de contraseña</h2>
    <p>
        A continuación podra cambiar la contraseña para el usuario <strong><?php echo $user; ?></strong>
    </p>
       <form method="post" id="formcontrasena" action="lib/updateContrasena.php">
        <ul>
            <li>
                <label for="anterior">Ingrese contraseña anterior: </label>
                <input type="password" maxlength="16" required name="passanterior" id="anterior">
            </li>
            <li>
                <label for="nueva">Ingrese nueva contraseña: </label>
                <input type="password" maxlength="16" required name="passnueva" id="nueva">
            </li>
            <li>
                <label for="reescrita">vuelva a escribir la contraseña:</label>
                <input type="password" maxlength="16" required name="passrept" id="reescrita">
            </li>
            <li>
                <button type="submit" id="enviar">Cambiar contraseña</button>
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
    <script src="../js/contrasenas.js"></script>
</html>