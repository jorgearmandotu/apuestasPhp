<!DOCTYPE HTML>
    <?php
    require_once 'validaciones.php';
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
       <title>administrador</title>
       <link rel="stylesheet" href="../css/normailze.min.css">
        <link rel="stylesheet" href="../css/estilos.css">
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
                 </ul>
          </header>
          <div id="contenido">
              <br>
              <center>
        <img src="../images/Interface-02.png" height="100px" ></center>
              <br>
              <div id="bloque">
        <ul>
            
            <li>
               <a href="ingresoUsuarios.php"><img src ="../images/agregar.png" height="80px"></a>
            </li>
            <li>
                <a href="generarSaldo.php"><img src ="../images/saldo.png" height="80px"></a>
            </li>
            <li>
                <a href="ingresoPartidos.php"><img src ="../images/ingresar.png" height="80px"></a>
            </li>
            <br>
            <li>
                <a href="actualizarcuotas.php"><img src ="../images/actualizarcuotas.png" height="80px"></a>
            </li>
            <li>
                <a href="cambiarContrasena.php"><img src ="../images/contrasena.png" height="80px"></a>
            </li>
            <li>
                <a href="apuestastotal.php"><img src ="../images/reportetotal.png" height="80px"></a>
            </li>
            <br>
            <li>
                <a href="aganadasbookie.php"><img src ="../images/reportepunto.png" height="80px"></a>
            </li>
            <li>

                <a href="actualizarganador.php"><img src ="../images/ganador.png" height="80px"></a>
            </li>
            <li>

                <a href="salir.php"><img src ="../images/cerrar.png" height="80px"></a>
            </li>
        </ul>
                  </div>
            </div>
            <footer>
              <img src="../images/Bookiesport_Logo.png">
              <p>
                  
                  
              </p>
          </footer>
        </div>
        
    </body>
</html>
