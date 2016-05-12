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
        <h1>administradores</h1>
        <ul>
            <li>
                <a href="ingresoUsuarios.php">agregar usuarios</a>
            </li>
            <li>
                <a href="generarSaldo.php">Agregar saldo a asesores</a>
            </li>
            <li>
                <a href="ingresoPartidos.php">Ingresar Partidos</a>
            </li>
            <li>
                <a href="actualizarcuotas.php">actualizar cuotas de partidos</a>
            </li>
            <li>
                <a href="cambiarContrasena.php">cambiar contraseña</a>
            </li>
            <li>
                <a href="apuestastotal.php">Reporte Total Apuestas</a>
            </li>
            <li>

                <a href="aganadasbookie.php">Reporte Apuestas ganadas por  punto</a>
            </li>
            <li>

                <a href="actualizarganador.php">Ingresar ganador de un partido</a>
            </li>
            <li>

                <a href="salir.php">cerrar sesion</a>
            </li>
        </ul>
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
