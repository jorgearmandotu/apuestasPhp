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
       <!--<link rel="stylesheet" href="../css/normailze.min.css">-->
        <link rel="stylesheet" href="../css/tablas.css">
        <link rel="stylesheet" href="../css/botton.css">
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
                         <a href="asesor.php"><img src='../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
          </header>
          <div id="contenido">
    <?php
        require_once('gestionDB.php');
        
        session_start();
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];
    ?>
    <center>
        
    <h2>Todas  mis apuestas</h2>
       <form method="post" id="apuestatotal" action="apuestaspersona.php">
        <label>Fecha de inicio</label>
        <input type="date" name="fecha1" id="fecha1" required>
           <label>Fecha Fin</label>
        <input type="date" name="fecha2" id="fecha2" required>
        <button type="submit" id="button1">Buscar</button>
        <a class="enlaceboton" href="pdf_apuestaspersona.php" target="_blank">Exportar a PDF</a>
        <br>
        <br>
        <?php
           
           echo('<table cellspacing="3" CELLPADDING="4" border="3">');
               echo('<tr>');
               echo('<th>Nombre Apostador</th>');
               echo('<th>CC</th>');
               echo('<th>Valor</th>');
               echo('<th>Asesor</th>');
               echo('<th>Partido</th>');
               echo('<th>Equipo</th>');
               echo('</tr>');
           $enlace = connectionDB();
           $fecha1=strip_tags($_POST['fecha1']);
           $fecha2=strip_tags($_POST['fecha2']);
           mysqli_query($enlace,"UPDATE fecha set fechaA='$fecha1', fechaB='$fecha2' where ID='1'")
    or die("error al actualizar");
           $apuesta=apuestass($enlace,$fecha1,$fecha2);
           for($i=0;$i<count($apuesta);$i++) {
            if($apuesta[$i][3]==$idusuario){
           echo('<tr>');
               echo('<td>'.$apuesta[$i][0].'</th>');
               echo('<td>'.$apuesta[$i][1].'</td>');
               echo('<td>'.$apuesta[$i][2].'</td>');
               $persona = asesor($enlace,$apuesta[$i][3]);
               echo('<td>'.$persona[0].'</td>');
               $partido=equiposLigaPartido($enlace,$apuesta[$i][4]);
               echo('<td>'.$partido[0].' VS '.$partido[1].'</td>');
               if($apuesta[$i][5]=='1'){
               echo('<td>'.$partido[0].'</td>');}
               
               if($apuesta[$i][5]=='2'){
               echo('<td>'.$partido[1].'</td>');}
               if($apuesta[$i][5]=='X'){
               echo('<td>EMPATE</td>');}
               echo('</tr>');
            }
           }
               echo('</table>');
           connectionClose($enlace);
           ?>
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