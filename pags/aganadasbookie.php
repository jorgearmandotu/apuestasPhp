
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
       <title>Apuestas Ganadas En cada punto</title>
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
          </header>
          <div id="contenido">
    <?php
        require_once('gestionDB.php');
        
        session_start();
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];
    ?>
    <center>
        
    <h2>Apuestas ganadas y perdidas por cada punto</h2>
       <form method="post" id="apuesganada" action="aganadasbookie.php" method="post">
       
        <label>Fecha de inicio</label>
        <input type="date" name="fecha1" id="fecha1" required>
           <label>Fecha Fin</label>
        <input type="date" name="fecha2" id="fecha2" required>
        <button type="submit" id="button1">Buscar</button>
          
        <a class="enlaceboton" href="pdf_aganadasbookie.php" target="_blank" id="pdf2">Exportar a PDF</a>
        <br>
        <br>
        <input type="hidden" name="conta">
       
        <?php
            $i=0;
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
        
           $enlace = connectionDB();
           $personaa=tpersona($enlace);
           if($i!=0){
           for($j=0;$j<count($personaa);$j++) {
               echo('<h3>Puesto de control '.$personaa[$j][0].'</h3>');
           
           echo('<table cellspacing="3" CELLPADDING="4" border="3">');
               echo('<tr>');
               echo('<th>Numero referencia</th>');
               echo('<th>Cuota</th>');
               echo('<th>Valor Apostado</th>');
               echo('<th>Asesor</th>');
               echo('<th>Valor a pagar</th>');
               echo('</tr>');
           
           $fecha1=strip_tags($_POST['fecha1']);
           $fecha2=strip_tags($_POST['fecha2']);
            $fechat= acfecha($enlace,$idusuario);
               
                if($fechat[2]==$idusuario){
                    mysqli_query($enlace,"UPDATE fecha set fechaA='$fecha1', fechaB='$fecha2' where ID='$idusuario'")
                    or die("error actualise  la paginaaa");
                }else{mysqli_query($enlace,"INSERT INTO fecha VALUES ('".$fecha1."','".$fecha2."','".$idusuario."')")
                    or die("error actualise  la pagina");}
            
           
           $apuesta=idapuesta($enlace,$fecha1,$fecha2);
            $apostado=0.0;
            $ganadot=0.0;
            $ganado=0.0;
            
           for($i=0;$i<count($apuesta);$i++) {
               $cuota = 1.0;
               $band = 0;
               $bandd = 0;
               $apuesta1=apuestass($enlace,$apuesta[$i][0]);
               $bandp = NULL;
               for($k=0;$k<count($apuesta1);$k++) {
                   $cuota=$apuesta1[$k][1]*$cuota;
                   $partido=equiposLigaPartido($enlace,$apuesta1[$k][4]);
                   $bandp=$apuesta1[$k][3];
                   if($apuesta1[$k][5]!=$partido[4] and $apuesta1[$k][3]==$personaa[$j][1]){
                      $band=1;
                       if($partido[4]==NULL){$bandd=2;}
                   }
                   
               }
               $pagar = $cuota*$apuesta[$i][1];
               
               
               
               if($band==0 and $bandp==$personaa[$j][1]){
                   $apostado = $apuesta[$i][1]+$apostado;
                   $ganadot = $pagar+$ganadot;
                   echo('<tr bgcolor="red">');
               
                   echo('<td>'.$apuesta[$i][0].'</th>');
                   echo('<td>'.$cuota.'</td>');
                   echo('<td>'.$apuesta[$i][1].'</td>');
                   $persona = asesor($enlace,$apuesta[$i][2]);
                   echo('<td>'.$persona[0].'</td>');
                   echo('<td>'.$pagar.'</td>');
                   echo('</tr>');
               }
               if($band==1 and $bandp==$personaa[$j][1] and $bandd==0){
                   $apostado = $apuesta[$i][1]+$apostado;
                   $ganadot = $pagar+$ganadot;
                   $ganado = $pagar+$ganado;
                   echo('<tr bgcolor="green">');
               
                   echo('<td>'.$apuesta[$i][0].'</th>');
                   echo('<td>'.$cuota.'</td>');
                   echo('<td>'.$apuesta[$i][1].'</td>');
                   $persona = asesor($enlace,$apuesta[$i][2]);
                   echo('<td>'.$persona[0].'</td>');
                   echo('<td>'.$pagar.'</td>');
                   echo('</tr>');
               }
               
           }
                echo('<tr>');
                echo('<td>Valor total apostado: </td>');
                echo('<td colspan="2">'.$apostado.'</td>');
                echo('</tr>');
                echo('<tr>');
                echo('<td>Valor a pagar total: </td>');
                echo('<td colspan="2">'.$ganadot.'</td>');
                echo('</tr>');
                echo('<tr>');
                echo('<td>Valor a pagar ganado: </td>');
                echo('<td colspan="2">'.$ganado.'</td>');
                echo('</tr>');
               echo('</table>');
              
           }
           }
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