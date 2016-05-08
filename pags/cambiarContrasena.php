<!DOCTYPE HTML>
<html lang="es">
   <head>
       <meta charset="utf-8">
       <title>cambiarContraseña</title>
   </head>
    <body>
    <?php
        require_once('gestionDB.php');
        
        session_start();
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];
    ?>
    <div id="contenido">
    <h2>Cambio de contraseña</h2>
    <p>
        A continuación podra cambiar la contraseña para el usuario <?php echo $user; ?>
    </p>
       <form method="post" id="formcontrasena" action="lib/updateContrasena.php">
        <ul>
            <li>
                <label>Ingrese contraseña anterior: </label>
                <input type="password" maxlength="16" required name="passanterior">
            </li>
            <li>
                <label>Ingrese nueva contraseña: </label>
                <input type="password" maxlength="16" required name="passnueva">
            </li>
            <li>
                <label>vuelva a escribir la contraseña:</label>
                <input type="password" maxlength="16" required name="passrept">
            </li>
            <li>
                <button type="submit" id="enviar">Cambiar contraseña</button>
            </li>
        </ul>
        </form>
        
        <a href="administrador.php">Inicio</a>
        </div>
    </body>
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="../js/contrasenas.js"></script>
</html>