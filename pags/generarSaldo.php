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
       <title>asesor</title>
       <link rel="stylesheet" href="../css/normailze.min.css">
        <link rel="stylesheet" href="../css/estilosform.css">
        <link rel="stylesheet" href="../css/saldo.css">
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
    
    <?php
        require_once('gestionDB.php');
        require_once('validaciones.php');
        validarAdmin();
        
    ?>
    <center>
    <table>
       <tr>
        <th>Asesor</th>
        <th>Saldo Actual</th>
        </tr>
        <?php
        $enlace= connectionDB();
        $ase = listAsesores($enlace);
        connectionClose($enlace);
        for($i=0;$i<count($ase);$i++){
            $l=0;
            echo("<tr><td class='tdasesor'>".$ase[$i][$l]."</td>");
            $l++;
            echo("<td class='tdsaldo'>".$ase[$i][$l]."</td></tr>");
           
        }
        ?>
        
    </table>
    
        <form  method="POST" action="lib/ingresoSaldo.php" id="ingresar">
        <select id='asesores' name='asesores'>
            <?php
        echo'<option value="seleccion">Seleccione asesor</option>';
            for($i=0;$i<count($ase);$i++){
                echo('<option value="'.$ase[$i][2].'">'.$ase[$i][0].'</option>');
            }
            ?>
    </select>
        <label>Saldo $: </label><input type="text" name="saldo"><button id="agregar">Agregar Saldo</button>
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