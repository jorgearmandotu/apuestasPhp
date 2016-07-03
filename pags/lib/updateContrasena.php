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
       <title>cambiarContraseña</title>
       <link rel="stylesheet" href="../../css/normailze.min.css">
        <link rel="stylesheet" href="../../css/estilosform.css">
        <link rel="stylesheet" href="../../css/sweetalert.css">
        <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="../../js/sweetalert.min.js"></script>
   </head>
    <body>
     <div id='contenedor'>
          <header id="cabecera">
             <div id="logo">
             </div>
                 <ul>
                     <li class="logoutico">
                       <a href="../salir.php">
                           <img src="../../images/Bookiesport_Usuario.png" alt="usuario"></a>
                     </li>
                     <li class="logout">
                         <a href="../salir.php">Salir</a>
                     </li>
                     <li id="salirico">
                         <a href="../asesor.php"><img src='../../images/Bookiesport_Inicio.png' alt="Inicio"></a>
                     </li>
                 </ul>
          </header>
          <div id="contenido">
<?php
require_once '../gestionDB.php';
require_once('../validaciones.php');
        if(!validarsession()){
            header('location: ../../index.php');
        }

    $passant=limpiarcadenas($_POST['passanterior']);
    $passnueva=limpiarcadenas($_POST['passnueva']);
    $passrpt=limpiarcadenas($_POST['passrept']);
    //session_start();
    $id = $_SESSION['id'];
?>

        <?php
        if($passnueva != $passrpt){
            echo '<script type="text/javascript">swal("las contraseñas no coinciden");</script>
            <a href="../cambiarContrasenaasesor.php"><button type="button" id="enviar">Volver</button></a>';
            
        }else{
            $enlace = connectionDB();
            if(verificarpassword($enlace,$id,$passant)){
                //ingresar nueva contraseña
                if(cambiarpassword($enlace,$passnueva,$id)){
                    connectionClose($enlace);
                 echo '<script type="text/javascript">swal("Contraseña cambiada exitosamente");</script>
                 <a href="../asesor.php"><button type="button" id="enviar">Inicio</button></a>'; 
                    
                }else{
                    connectionClose($enlace);
                    echo '<script type="text/javascript">swal("ocurrio un error vuelva a intentarlo");</script>
                    <a href="../cambiarContrasenaasesor.php"><button type="button" id="enviar">Volver</button></a>';
                    
                }
            }else{
                connectionClose($enlace);
                echo '<script type="text/javascript">swal("la contraseña introducida no es la correcta");</script>
                    <a href="../cambiarContrasenaasesor.php"><button type="button" id="enviar">Volver</button></a>';
                
            }
        }
        //header('location: ../cambiarContrasena.php');
        ?>

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