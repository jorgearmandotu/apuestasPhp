<!DOCTYPE HTML>
    <?php
    require_once 'validaciones.php';
require_once 'gestionDB.php';
    validarAdmin();
    ?>


<html lang="=es">
   <head>
       <meta charset="utf-8">
       <title>ingresar partidos</title>
   </head>
    <body>
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
                    <input type="number" step="any" required maxlength="4" name="cuota1">
                </li>
                <li>
                    <label>Cuota visitante (2)</label>
                    <input type="number" step="any" required max="4" name="cuota2">
                </li>
                <li>
                    <label>Cuota empate (X)</label>
                    <input type="number" step="any" required maxlength="4" name="cuotaX">
                </li>
                <li>
                    <button type="submit" id="enviar">AGREGAR</button> 
                </li>
            </ul>
        </form>
        <a href="administrador.php">Inicio</a>
    </center>
    
    
    </body>
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="../js/funciones.js"></script>
</html>