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
        <script src="../../js/modernizr-custom.js"></script>
          <script src="../../js/jquery-ui.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--          <script src="../js/funciones.js"></script>-->
      <script src="../../js/detalles.js"></script>
       <title>Apuestas Ganadas En cada punto</title>
       <link rel="stylesheet" href="../../css/normailze.min.css">
        <link rel="stylesheet" href="../../css/tablas.css">
        <link rel="stylesheet" href="../../css/botton.css">
   </head>
    <body>
       
        
     <div id='contenedor'>
          <header id="cabecera">
             <div id="logo">
                 
             </div>
                 <ul>
                     <li class="logoutico">
                       <a href="salir.php">
                           <img src="../../images/Bookiesport_Usuario.png" alt="usuario"></a>
                     </li>
                     <li class="logout">
                         <a href="../salir.php">Salir</a>
                     </li>
                     <li id="salirico">
                         <a href="../administrador.php"><img src='../../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
          </header>
          <div id="contenido">
          <center>
             <div id="ventana">
             <table class="detalles">
                        <legend>Detalles De Apuesta</legend>
                    <tr>
                    <th>partidos</th>
                    <th>liga</th>
                    <th>pais-liga</th>
                    <th>apuesta</th>
                    <th>cuota</th>
                    <th>resultado partido</th>
                    <th>estado</th>
                    </tr>
                    
              <?php
              require_once('../gestionDB.php');
              require_once('../validaciones.php');
            validarsession();
            
              
              if(isset($_POST['detalles'])){
                  $idapuesta = limpiarcadenas($_POST['detalles']);
                  $enlace = connectionDB();
                  $datosapuesta = idasesordeapuesta($enlace,$idapuesta);
                  $idasesor = $datosapuesta[0];
                  $asesor = asesor($enlace,$idasesor);
                  $fecha = $datosapuesta[1];
                  $valor = $datosapuesta[2];
                  $punto = nompunto($enlace,$idasesor);
                  $cuotat = 1;
                  $partidos = idpartidosApostados($enlace,$idapuesta);
                  $eventos = count($partidos);
                  
                  for($i=0;$i<$eventos;$i++){
                      //0=id partido 1= apuesta 2= cuotaapo
                      $cuotat*=$partidos[$i][2];
                      $resultado = resultadopartido($enlace,$partidos[$i][0]);
                      $estado="determinar";
                      $infopartido = infopartido($enlace,$partidos[$i][0]);
                      //0=equipo1 1=equipo2, 2=horapartido
                      $nomequiA = nomEquipo($infopartido[0],$enlace);
                      $nomequiB = nomEquipo($infopartido[1],$enlace);
                      $nompartido=$nomequiA.' vs '.$nomequiB;
                      $idliga = ligadeequipo($enlace,$infopartido[0]);
                      $datosliga = nompaisliga($enlace,$idliga);
                      //0=mpais 1=nombre
                      $paisLig = $datosliga[0];
                      $nomliga = $datosliga[1];
                       if($resultado!=$partidos[$i][1]){
                           $estado='<label class="perdio">perdio</label>';
                       }else if($resultado==$partidos[$i][1]){
                           $estado='<label class="gano">gano</label>';
                       }
                     echo'<tr>
                     <td>'.$nompartido.'</td>
                     <td>'.$nomliga.'</td>
                     <td>'.$paisLig.'</td>
                     <td>'.$partidos[$i][1].'</td>
                     <td>'.$partidos[$i][2].'</td>
                     <td>'.$resultado.'</td>
                     <td>'.$estado.'</td>
                     </tr>';
                      
                      
                  }
                  $Pgananacia=$cuotat*$valor;
                ?>
                 </table>
                 <table class="detalles">
                <tr>
                    <th>Id</th>
                    <th>asesor</th>
                    <th>punto</th>
                    <th>eventos</th>
                    <th>apuesta</th>
                    <th>cuota</th>
                    <th>ganacia</th>
                </tr>
                
                    <?php
                  
                  
                  echo'<tr><td>'.$idapuesta.'</td>
                  <td>'.$asesor.'</td>
                  <td>'.$punto.'</td>
                  <td>'.$eventos.'</td>
                  <td>'.$valor.'</td>
                  <td>'.$cuotat.'</td>
                  <td>'.$Pgananacia.'</td>
                  </tr>';
                  
                  ?>
              </table>
               
            
             <?php
              }else{
                  header('location:../dennyAcces.html');
              }
              
              ?>
              
            
        </div>
        <div id="opaco"></div>
          
          </center>
         </div>
         <footer>
              <img src="../../images/Bookiesport_Logo.png">
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