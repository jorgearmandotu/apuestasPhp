<?php
require_once '../gestionDB.php';
require_once('../validaciones.php');
        if(!validarsession()){
            header('location: ../../index.php');
        }

    $passant=limpiarcadenas($_POST['passanterior']);
    $passnueva=limpiarcadenas($_POST['passnueva']);
    $passrpt=limpiarcadenas($_POST['passrept']);
    session_start();
    $id = $_SESSION['id'];
?>
<html>
    <body>
        <?php
        if($passnueva != $passrpt){
            echo '<script type="text/javascript">alert("las contraseñas no coinciden")</script>';
        }else{
            $enlace = connectionDB();
            if(verificarpassword($enlace,$id,$passant)){
                //ingresar nueva contraseña
                if(cambiarpassword($enlace,$passnueva,$id)){
                    connectionClose($enlace);
                 echo '<script type="text/javascript">alert("lcontraseña cambiada exitosamente")</script>'; 
                }else{
                    connectionClose($enlace);
                    echo '<script type="text/javascript">alert("ocurrio un error vuelva a interntarlo")</script>';
                }
            }else{
                connectionClose($enlace);
                echo '<script type="text/javascript">alert("la contraseña introducida no es la correcta")</script>';
            }
        }
        header('location: ../cambiarContrasena.php');
        ?>
    </body>
</html>

