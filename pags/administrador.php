<!DOCTYPE HTML>
    <?php
    require_once 'validaciones.php';
    validarAdmin();
    ?>


<html lang="=es">
   <head>
       <meta charset="utf-8">
       <title>administrador</title>
   </head>
    <body>
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
                <a href="salir.php">cerrar sesion</a>
            </li>
        </ul>
    </body>
</html>
