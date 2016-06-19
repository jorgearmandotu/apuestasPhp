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
       <title>apuestas totales</title>
       <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script src="../js/modernizr-custom.js"></script>
          <script src="../js/jquery-ui.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <script src="../js/funciones.js"></script>
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
                         <a href="administrador.php"><img src='../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
              <?php
              $i=0;
              ?>
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
        
    <h2>Apuestas totales de Bookiesport</h2>
       <form method="post" id="apuestatotal" action="apuestastotal.php" method="post">
        <label>Fecha de inicio</label>
        <input type="date" name="fecha1" id="fecha1" required>
           <label>Fecha Fin</label>
        <input type="date" name="fecha2" id="fecha2"  required >
        <button type="submit" id="button1">Buscar</button>
        <a class="enlaceboton" href="pdf_apuestastotal.php" target="_blank">Exportar a PDF</a>
        <br>
        <br>
           <input type="hidden" name="conta">
        <?php
           if ($_POST){
//Incrementamos el valor
               $i++;
               $conta = $_POST["conta"] + 1;
           }
           else{
//Valor inicial
            $i=0;   
               $conta = 1;
           }
           
           if($i!=0){
           echo('<table cellspacing="3" CELLPADDING="4" border="3">');
               echo('<tr>');
               echo('<th>Numero referencia</th>');
               echo('<th>Cuota</th>');
               echo('<th>Valor Apostado</th>');
               echo('<th>Asesor</th>');
               echo('<th>Valor a pagar</th>');
               echo('</tr>');
           $enlace = connectionDB();
           
           $fecha1=limpiarcadenas($_POST['fecha1']);
           $fecha2=limpiarcadenas($_POST['fecha2']);
               
               $fechat= acfecha($enlace,$idusuario);
            
                if($fechat[2]==$idusuario){
                    mysqli_query($enlace,"UPDATE fecha set fechaA='$fecha1', fechaB='$fecha2' where ID='$idusuario'")
                    or die("error actualise  la paginaaa");
                }else{mysqli_query($enlace,"INSERT INTO fecha VALUES ('".$fecha1."','".$fecha2."','".$idusuario."')")
                    or die("error actualise  la pagina");}
          
           //$apuestaid = idapuesta(enlace);
            $apostado =0.0;
           $apuesta=idapuesta($enlace,$fecha1,$fecha2);
           for($i=0;$i<count($apuesta);$i++) {
               $cuota = 1.0;
               
               $apuesta1=apuestass($enlace,$apuesta[$i][0]);
               for($j=0;$j<count($apuesta1);$j++) {
                   $cuota=$apuesta1[$j][1]*$cuota;
               }
               $pagar = $cuota*$apuesta[$i][1];
               $apostado = $apuesta[$i][1]+$apostado;
           echo('<tr>');
               echo('<td>'.$apuesta[$i][0].'</th>');
               echo('<td>'.$cuota.'</td>');
               echo('<td>'.$apuesta[$i][1].'</td>');
               $persona = asesor($enlace,$apuesta[$i][2]);
               echo('<td>'.$persona[0].'</td>');
               echo('<td>'.$pagar.'</td>');
               echo('</tr>');
           }//cierra for i
        
               echo('</table>');
               echo('<h3>Valor total apostado '.$apostado.'</h3>');
               
               connectionClose($enlace);
           }//cierra if
           
           
           
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
    
    <script src="../js/contrasenas.js"></script>
</html>