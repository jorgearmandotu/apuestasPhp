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
<!--          <script src="../js/funciones.js"></script>-->
          <script src="../js/funciones.js"></script>
       <title>reporte</title>
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
                         <a href="asesor.php"><img src='../images/Bookiesport_Inicio.png' alt="Inicio"></a>
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
        
    <h2>Todas  mis apuestas</h2>
       <form method="post" id="apuestatotal" action="<?php echo limpiarcadenas($_SERVER["PHP_SELF"]);?>" method="post">
        <label>Fecha de inicio</label>
        <input type="date" name="fecha1" id="fecha1" required>
           <label>Fecha Fin</label>
        <input type="date" name="fecha2" id="fecha2" required>
        <button type="submit" id="button1">Buscar</button>
        <a class="enlaceboton" href="pdf_apuestaspersona.php" target="_blank">Exportar a PDF</a>
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
               
               echo'<table id="tabla">';
               echo'<tr><th>Id Apuesta</th>
                   <th>Valor Apostado</th>
                   <th>Eventos</th>
                   <th>Fecha Apuesta</th>
                   <th>Ganancia Potencial</th>
                   <th>Estado</th>
                   </tr>';
            
               $enlace = connectionDB();
               $apuestas = listapuestasAsesor($enlace,$idusuario,$fechaA,$fechaB);
               for($l=0;$l<count($apuestas);$l++){
                   //$l,1=idapuesta, $l,2=valor, $l3=fechaapuesta
                    $idapuesta = $apuestas[$l][0];
                    $valorpuesta = $apuestas[$l][1];
                    $fechaapuesta = $apuestas[$l][2];
                   $fechaapuesta= new datetime($fechaapuesta);
                   $fechaapuesta = $fechaapuesta->format('Y-m-d');
                   $datosapuesta = idpartidosApostados($enlace,$idapuesta);
                    $cuotat = 1;$estado='determinar';
                   for($k=0;$k<count($datosapuesta);$k++){
                        $cuotat*=$datosapuesta[$k][2];
                        $resultado = resultadopartido($enlace,$datosapuesta[$k][0]);
                        $cantidadeventos = count($datosapuesta);
                        
                        if($resultado!=''){
                            if($resultado!=$datosapuesta[$k][1] and $estado!='Por Determinar'){
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
                   $Pgananacia=$cuotat*$valorpuesta;
                   echo'<tr><td>'.$idapuesta.'</td>';
                    echo'<td>'.$valorpuesta.'</td>';
                    echo'<td>'.$cantidadeventos.'</td>';
                    echo'<td>'.$fechaapuesta.'</td>';
                    echo'<td>'.$Pgananacia.'</td>';
                    echo'<td>'.$estado.'</td></tr>';
               }
               connectionClose($enlace);
               echo'</table>';
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