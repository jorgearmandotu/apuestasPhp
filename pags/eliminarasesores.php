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
          <script src="../js/funciones.js"></script>
       <title>ingresar partidos</title>
       <link rel="stylesheet" href="../css/normailze.min.css">
        <link rel="stylesheet" href="../css/estilosform.css">
        <link rel="stylesheet" href="../css/saldo.css">
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
       
    <table>
       <tr>
       <th>Punto</th>
       <th>CC</th>
        <th>Asesor</th>
        <th>Saldo Actual</th>
        </tr>
        <?php
        $enlace= connectionDB();
        $ase = listAsesores($enlace);
        connectionClose($enlace);
        for($i=0;$i<count($ase);$i++){
            $l=0;
            echo("<tr><td class='punto'>".$ase[$i][3]."</td>");
            echo("<td class='tdasesor'>".$ase[$i][2]."</td>");
            echo("<td class='tdasesor'>".$ase[$i][$l]."</td>");
            $l++;
            echo("<td class='tdsaldo'>".$ase[$i][$l]."</td></tr>");
           
        }
        ?>
        </table>
        <form  method="POST" action="lib/eliminarasesor.php" >
        <select id='asesores' name='asesores'>
            <?php
        echo'<option value="seleccion">Seleccione asesor</option>';
            for($i=0;$i<count($ase);$i++){
                echo('<option value="'.$ase[$i][2].'">'.$ase[$i][0].'</option>');
            }
            ?>
        </select>
        <button type="submit">Eliminar</button>
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
    
</html>