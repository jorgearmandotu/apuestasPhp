
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
       <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script src="../js/modernizr-custom.js"></script>
          <script src="../js/jquery-ui.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <script src="../js/funciones.js"></script>
       <title>Apuestas Ganadas En cada punto</title>
       <link rel="stylesheet" href="../css/normailze.min.css">
        <link rel="stylesheet" href="../css/tablas.css">
        <link rel="stylesheet" href="../css/botton.css">
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
    <?php
        require_once('gestionDB.php');
        require_once('validaciones.php');
        validarAdmin();
        
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];
    ?>
    <center>
        
    <h2>Apuestas ganadas y perdidas por cada punto</h2>
       <form method="post" id="apuesganada" action="<?php echo limpiarcadenas($_SERVER["PHP_SELF"]);?>" method="post">
       
        <label>Fecha de inicio: </label>
        <input type="date" name="fecha1" id="fecha1" required>
           <label>Fecha Fin: </label>
        <input type="date" name="fecha2" id="fecha2" required>
        <button type="submit" id="button1">Buscar</button>
          
        <a class="enlaceboton" href="pdf_aganadasbookie.php" target="_blank" id="pdf2">Exportar a PDF</a>
        <br>
        <br>
        <input type="hidden" name="conta">
       
        <?php
           $consulta = false;
           if(isset($_POST['fecha1']) and isset($_POST['fecha2'])){
               $consulta = true;
           }
           if($consulta){
               $fechaA = limpiarcadenas($_POST['fecha1']);
               $fechaB = limpiarcadenas($_POST['fecha2']);
            
               $enlace = connectionDB();
               $asesores = listAsesores($enlace);
               echo'<table id="tabla">';
               for($i=0;$i<count($asesores);$i++){
                   //$i,0=nombre ya pellido $i,1=saldo, $i,2=cc, $i,3=punto, $i,4=usuario,
                   $idAsesor=$asesores[$i][2];
                   echo'<tr><th class="asesor">Asesor: '.$asesores[$i][4].'</th><th class="punto"> Punto: '.$asesores[$i][3].'</th></tr>';
                   echo'<tr><th>Id Apuesta</th>
                   <th>Valor Apostado</th>
                   <th>Fecha Apuesta</th>
                   <th>Posible Ganancia</th>
                   <th>Estado</th>
                   </tr>';
                   $apuestas = listapuestasAsesor($enlace,$idAsesor,$fechaA,$fechaB);
                   for($l=0;$l<count($apuestas);$l++){
                       //$l,1=idapuesta, $l,2=valor, $l3=fechaapuesta
                       $idapuesta = $apuestas[$l][0];
                       $valorpuesta = $apuestas[$l][1];
                       $fechaapuesta = $apuestas[$l][2];
                       echo'<tr><td>'.$idapuesta.'</td>';
                       echo'<td>'.$valorpuesta.'</td>';
                       echo'<td>'.$fechaapuesta.'</td>';
                       echo'<td>ganacia</td>';
                       echo'<td>estado</td></tr>';
                   }
                   
               }
               connectionClose($enlace);
               echo'</table>';
               $apuestas = listapuesta($enlace,$fechaA,$fechaB);
               /*for($i=0;$i<count($apuestas);$i++){
                   //i,0=idapuesta, i.1=valor, i,2=idasesor, i,3=fecha apuesta
                   $idapuesta=$apuestas[$i][0];
                   $idasesor=$apuestas[$i][2];
                   $asesor = asesor($enlace,$idasesor);
                   $fecha = $apuestas[$i][3];
                   $fecha= new datetime($fecha);
                   $fecha = $fecha->format('Y-m-d');
                   $valor = $apuestas[$i][1];
                   $datosapuesta = idpartidosApostados($enlace,$idapuesta);
                   $cantPartidos = count($datosapuesta);
                   $cuotat=1;
                   $estado='determinar';
                   $estado;
                echo('<table id="tabla">');
               echo('<tr>');
               echo('<th>Numero referencia</th>');
               echo('<th>Cuota</th>');
               echo('<th>Valor Apostado</th>');
               echo('<th>Asesor</th>');
               echo('<th>Valor a pagar</th>');
               echo('</tr>');
            
                   for($l=0;$l<count($datosapuesta);$l++){
                        //l,0=idpartido, l,1=apuesta, l,2=cuota
                       $cuotat*=$datosapuesta[$l][2];
                       $resultado = resultadopartido($enlace,$datosapuesta[$l][0]);
                       if($resultado!=''){
                           if($resultado!=$datosapuesta[$l][1] and $estado!='Por Determinar'){
                               $estado='<label class="perdio">perdio</label>';
                           }else{
                               if($estado!='perdio' and $estado!='Por Determinar'){
                                   $estado='<label class="gano">gano</label>';
                               }
                           }
                       }else{
                         $estado='Por Determinar';  
                       }
                   }
                   $Pgananacia=$cuotat*$valor;
                   echo '</table>';
           }*/
           }
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