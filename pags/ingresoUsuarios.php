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
             
              <form method="post" action="ingresosUpdates.php" id="formularioAsesor" onsubmit="return confirmar()">
                 <ul>
                    <li>
                        <label>Nombre: </label>
                        <input type="text" name='nombre' required maxlength="20">
                    </li>
                    <li>
                        <label>Apellido: </label>
                        <input type="text" name="apellido" required maxlength="20">
                    </li>
                    <li>
                        <label>Cedula: </label>
                        <input type="text" name="cedula" required maxlength="20">
                    </li>
                    <li>
                        <label>Telefono: </label>
                        <input type="tel" name="telefono" required maxlength="15">
                    </li>
                    <li>
                        <label>Email: </label>
                        <input type="email" name="email" required maxlength="40">
                    </li>
                    <li>
                       <label>Tipo: </label>
                        <select name="tipo">
                            <option>ASESOR</option>
                            <option>CLIENTE</option>
                        </select>
                    </li>
                    <li>
                        <label>ID Usuario: </label>
                        <input type="text" name="usuario" required maxlength="10">
                    </li>
                     <li>
                         <label>Contraseña: </label>
                         <input type="password" name="password" required maxlength="16" placeholder="maximo 16 caracteres">
                     </li>
                     <li>
                         <label>vuelva a ingresar contraseña: </label>
                         <input type="password" name="passwordverificacion" required maxlength="16" placeholder="maximo 16 caracteres">
                     </li>
                     <li>
                         <button type="submit" name="ingresar" id="btnIngAsesor">Ingresar</button>
                     </li>
                 </ul>
                  <div id='result'></div>
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