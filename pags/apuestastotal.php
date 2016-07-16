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
       <link rel="stylesheet" href="../css/normailze.min.css">
        <link rel="stylesheet" href="../css/tablas.css">
        <link rel="stylesheet" href="../css/botton.css">
   </head>
    <body>
     <div id='contenedor'>
          <header>
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
        if(!validarsession()){
            header('location: ../index.php');
        }
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];
              
    ?>
    <center>
        
    <h2>Apuestas totales de Bookiesport</h2>
       <form method="post" id="apuestatotal" action="<?php echo limpiarcadenas($_SERVER["PHP_SELF"]);?>" method="post">
        <label>Fecha de inicio</label>
        <input type="date" name="fecha1" id="fecha1" required>
           <label>Fecha Fin</label>
        <input type="date" name="fecha2" id="fecha2"  required >
        <button type="submit" id="button1">Buscar</button>
        
        <?php
           $consulta=false;
           if(isset($_POST['fecha1'])and isset($_POST['fecha2'])){
               $fechaA=limpiarcadenas($_POST['fecha1']);
               $fechaB=limpiarcadenas($_POST['fecha2']);
               $consulta=true;
           }
           if($consulta){
               
               echo'<a class="enlaceboton" href="pdf_apuestastotal.php?fecha1='.$fechaA.'&fecha2='.$fechaB.' " target="_blank">Exportar a PDF</a>';
               
               echo('<table id="tabla">');
               echo('<tr>');
               echo('<th>Numero referencia</th>');//idapuesta-
               echo('<th>Eventos</th>');//cantidad de pártidos-
               echo('<th>Asesor</th>');//quien realiso la apuesta-
               echo('<th>Fecha Apueta</th>');//fecha apuesta-
               echo('<th>Valor Apostado</th>');//valor apostado-
               echo('<th>Ganancia Potencial</th>');//posible ganancia-
               //echo('<th>fecha evento</th>');//fecha ultimo evento si es mas de 1 partido
               echo('<th>Estado</th>');//gano,perdio,enproceso
               echo('</tr>');
               
               $enlace = connectionDB();
               $apuestas = listapuesta($enlace,$fechaA,$fechaB);
               for($i=0;$i<count($apuestas);$i++){
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
                   for($l=0;$l<count($datosapuesta);$l++){
                        //l,0=idpartido, l,1=apuesta, l,2=cuota
                       $cuotat*=$datosapuesta[$l][2];
                       $resultado = resultadopartido($enlace,$datosapuesta[$l][0]);
                       if($resultado!=''){
                           if($resultado!=$datosapuesta[$l][1] and $estado!='Por Determinar'){
                               $estado='<label class="perdio">perdio</label>';
                           }else{
                               if($estado!='<label class="perdio">perdio</label>' and $estado!='Por Determinar'){
                                   $estado='<label class="gano">gano</label>';
                               }
                           }
                       }else{
                         $estado='Por Determinar';  
                       }
                   }
                   $Pgananacia=$cuotat*$valor;
                   echo'<tr>
                   <td class="celdas">'.$idapuesta.'</td>
                   <td class="celdas">'.$cantPartidos.'</td>
                   <td class="celdas">'.$asesor.'</td>
                   <td class="celdas">'.$fecha.'</td>
                   <td class="celdas">'.$valor.'</td>
                   <td class="celdas">'.$Pgananacia.'</td>
                   <td class="celdas">'.$estado.'</td>';
               }
               
               echo '</table>';
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